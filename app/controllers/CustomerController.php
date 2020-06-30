<?php

/**
 * Class ProductController
 */
class CustomerController extends Controller
{

    /**
     *
     */
    public function IndexAction()
    {
        $this->ListAction();

    }

    /**
     *
     */
    public function ListAction()
    {
        $this->setTitle("Клієнти");
        $this->registry['customer'] = $this->getModel('Customer')->initCollection()
               ->sort($this->getSortParams())->getCollection()->select();

        $this->setView();
        $this->renderLayout();
    }
    public function RegistrationAction()
    {

        $model = $this->getModel('Customer');
        $this->setTitle("Додавання користувача");
        if ($values = $model->getPostValues()) {
            $model->registrationItem($values);
        }
        $this->setView();
        $this->renderLayout();
    }
     public function LoginAction()
    {
        $this->setTitle("Вхід");
        if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST')
        {
            $email = filter_input(INPUT_POST, 'email');
            $password = md5(filter_input(INPUT_POST, 'password'));
            $params =array (
                'email'=>$email,
                'password'=> $password
            );
            $customer = $this->getModel('customer')->initCollection()
                    ->filter($params)
                    ->getCollection()
                    ->selectFirst();
            if(!empty($customer)) {
                $_SESSION['id'] = $customer['customer_id'];
                 $_SESSION['name'] = $customer['last_name']." ".$customer['first_name'];
                Helper::redirect('/index/index');
            } else {
                $this->invalid_password = 1;
            }
        }
        $this->setView();
        $this->renderLayout();
    }

    public function LogoutAction()
    {
        
        $_SESSION = [];

       // expire cookie

        if (!empty($_COOKIE[session_name()]))
        {
            setcookie(session_name(), "", time() - 3600, "/");
        }

        session_destroy();
        Helper::redirect('/index/index');
    }
     
}