<?php
namespace app;

class Entity {

    /**
     * Entity constructor.
     * @param array $data
     */
    public function __construct(array $data = []) {
        $this->hydrate($data);
    }

    /**
     * Une fonction qui permet d'hydrater une entité donnée
     * @param array $data
     */
    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            // récupération du setter
            $method = 'set'.ucfirst(str_replace('_', '', $key));

            // On appel le setter s'il existe
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
}
