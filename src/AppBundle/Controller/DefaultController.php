<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/signin", name="user_login")
     */
    public function loginAction(Request $request){
        // i thought it was in the parent controller but it s here so if u want to check the other comment go there lol
        $username=$request->get('username');
        $password=$request->get('password');

        if($request->isMethod("GET")){
            return $this->render("FOSUserBundle:Security:login.html.twig",array("msg"=>""));
        }else{

            // Retrieve the security encoder of symfony
            $factory = $this->get('security.encoder_factory');


            $user_manager = $this->get('fos_user.user_manager');
            //$user = $user_manager->findUserByUsername($username);
            // Or by yourself
            $user = $this->getDoctrine()->getManager()->getRepository("AppBundle:User")
                ->findOneBy(array('username' => $username));
            /// End Retrieve user

            // Check if the user exists !
            if(!$user){
                return $this->render("FOSUserBundle:Security:login.html.twig",array("msg"=>"user does not exist"));
            }

            /// Start verification
            $encoder = $factory->getEncoder($user);
            $salt = $user->getSalt();

            if(!$encoder->isPasswordValid($user->getPassword(), $password, $salt)) {
                return $this->render("FOSUserBundle:Security:login.html.twig",array("msg"=>"username or password are incorrect"));
            }
            /// End Verification

            // The password matches ! then proceed to set the user in session

            //Handle getting or creating the user entity likely with a posted form
            // The third parameter "main" can change according to the name of your firewall in security.yml
            $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
            $this->get('security.token_storage')->setToken($token);

            // If the firewall name is not main, then the set value would be instead:
            // $this->get('session')->set('_security_XXXFIREWALLNAMEXXX', serialize($token));
            $this->get('session')->set('_security_main', serialize($token));

            // Fire the login event manually
            $event = new InteractiveLoginEvent($request, $token);
            $this->get("event_dispatcher")->dispatch("security.interactive_login", $event);

            // $us=$this->container->get('security.token_storage')->getToken()->getUser();

            $flagadmin=$this->container->get('security.authorization_checker')->isGranted("ROLE_ADMIN");
            if ($flagadmin) {
                // SUPER_ADMIN roles go to the `admin_home` route
                return $this->redirectToRoute("event_index");
            }elseif($this->container->get('security.authorization_checker')->isGranted('ROLE_CLIENT')) {
                // Everyone else goes to the `home` route
                return $this->redirectToRoute("event_list");
            }

        }
    }

}
