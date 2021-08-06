<?php
    
    namespace proyecto;
    class Auth
    {
        private    $user;
        /**
         * @return mixed
         */
        public function getUser()
        {
            $session = new Session();
            $this->user= $session->get('user');
            return $this->user;
        }
        /**
         * @param mixed $user
         */
        public function setUser($user): void
        {
            $session = new Session();
            $session->set('user', $user);
            $this->user = $user;
        }
        public function clearUser(): void
        {
            $se=new Session();
            $se->remove("user");
        }
    
        
    
        
    }
