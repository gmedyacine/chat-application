<?php

namespace src\Controller;


use src\Entity\chatSession;
use src\Entity\Message;
use src\Home;
use src\Manager\ChatSessionManager;
use src\Manager\MessageManager;
use src\Repository\ChatSessionRepository;
use src\Repository\MessageRepository;
use src\Repository\UserRepository;

/**
 * Class ChatController
 * @package src\Controller
 */
class ChatController extends HomeController
{
    /**
     * ChatController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['auth'])) {
            header("Location: /?p=default.login");
            die();
        }
    }

    /**
     * La page home qui affiche tous les messages
     */
    public function index(): void
    {
        if (!empty($_POST)) {
            $app = Home::getInstance();
            $messageManager = new MessageManager($app->getDb());

            $message = new Message([
                "content" => $_POST['content'],
                "userId" => $_SESSION['auth']
            ]);

            $messageManager->add($message);


        }
        $this->render('home');
    }

    /**
     * Quand rafraichit la page, on recheck les messages et les users connectés
     */
    public function refresh(): void
    {
        $app = Home::getInstance();
        $messageRepository = new MessageRepository($app->getDb());
        $userRepository = new UserRepository($app->getDb());
        $response = [];

        $messages = $messageRepository->findAll();
        foreach ($messages as $message) {
            $user = $userRepository->find($message->getUser()->getId());
            $response[$message->getId()]['content'] = $message->getContent();
            $response[$message->getId()]['username'] = $user->getUsername();
            $response[$message->getId()]['createdAt'] = $message->getDatetime();
        }

        echo json_encode($response);
    }

    /**
     * On vérifie que la session est toujours OK
     */
    public function checkConnection(): void
    {
        $app = Home::getInstance();
        $chatSessionsRepository = new ChatSessionRepository($app->getDb());
        $chatSessionManager = new ChatSessionManager($app->getDb());
        $userRepository = new UserRepository($app->getDb());
        $chatSessions = $chatSessionsRepository->findAll();
        $connectedUsers = [];
        $new = true;

        foreach ($chatSessions as $chatSession) {

            if ($chatSession->getUser()->getId() == $_SESSION['authenticated']) {
                $chatSessionManager->update($chatSession);
                $new = false;
            }

            $now = new \DateTime();
            $updatedAt = new \DateTime($chatSession->getDatetime());
            $interval = $updatedAt->diff($now);

            if ($interval->format('%y') > 0
                || $interval->format('%m') > 0
                || $interval->format('%d') > 0
                || $interval->format('%h') > 0
                || $interval->format('%i') > 5
            ) {
                $chatSessionManager->remove($chatSession->getId());
            } else {
                $connectedUsers[] = $userRepository->find($chatSession->getUser())->getId();
            }
        }

        if ($new) {
            $newChatSession = new ChatSession([
                "userId" => $_SESSION['authenticated']
            ]);
            $chatSessionManager->add($newChatSession);
            $connectedUsers[] = $userRepository->find($newChatSession->getUser()->getId())->getName();
        }

        echo json_encode($connectedUsers);
    }

    /**
     * Pour déconnecter l'utilisateur en cours
     */
    public function logout(): void
    {
        $app = Home::getInstance();
        $chatSessionRepository = new ChatSessionRepository($app->getDb());
        $chatSessionManager = new ChatSessionManager($app->getDb());
        $chatSession = $chatSessionRepository->findByUserId($_SESSION['authenticated']);
        $chatSessionManager->remove($chatSession->getId());
        unset($_SESSION['authenticated']);
        header("Location: /?p=default.login");
    }
}
