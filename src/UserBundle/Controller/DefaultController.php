<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     * @Template()
     */
    public function indexAction(){
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/registration", name = "registration")
     */
    public function addUserAction(Request $request){
        $mail = $request->request->get("mail");

        if(strpos($mail, "@") <= 1){
        	return $this->redirectToRoute('index');
        }

        $nickname = explode('@', $mail)[0];

        $model = $this->getDoctrine()->getManager();

        $user = new User();
        $user->setNickname($nickname);
        $user->setMail($mail);
        $user->setPasswd(md5($request->request->get("passwd1")));
        $user->setPosts(0);
        $user->setCdate(date("Y-m-j"));

        $model->persist($user);
        $model->flush();

        $userId = $user->getId();

        setcookie("uid", $userId);
        setcookie("sid", md5($mail));

        return $this->redirectToRoute('profile', array('id' => $userId));
    }

    /**
     * @Route("/authors", name = "authors")
     * @Template()
     */
    public function usersAction(){
        $users = $this->getDoctrine()->getRepository("UserBundle:user")->findAll();

        return $this->render('default/authors.html.twig', array('users' => $users));
    }

    /**
     * @Route("/profile/{id}", name = "profile")
     * @Template()
     */
    public function profileAction($id){
    	$uid = $_COOKIE["uid"];
    	$sid = $_COOKIE["sid"];

    	$user = $this->getDoctrine()->getRepository("UserBundle:user")->find($id);

    	if($uid != $id)
        	return $this->render('default/author.html.twig', array('user' => $user));
        else
			return $this->render('default/profile.html.twig', array('user' => $user));
    }


}
