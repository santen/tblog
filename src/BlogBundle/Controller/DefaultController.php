<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use BlogBundle\Entity\Post;
use BlogBundle\Entity\Rubric;

class DefaultController extends Controller
{
	/**
     * @Route("/posts/{authorId}", name="posts")
     * @Template()
     */
    public function indexAction($authorId){
    	$author = $this->getDoctrine()->getRepository("UserBundle:user")->find($authorId);
    	$posts = $this->getDoctrine()->getRepository("BlogBundle:post")->findBy(array('author_id' => $authorId));

        return $this->render('BlogBundle:Default:posts.html.twig', array('author' => $author, 'posts' => $posts));
    }

    /**
     * @Route("/rubrics/{authorId}", name="rubrics")
     * @Template()
     */
    public function getRubricsAction($authorId){
		$rubrics = $this->getDoctrine()->getRepository("BlogBundle:rubric")->findBy(array('author_id' => $authorId));

		return $this->render('BlogBundle:Default:rubrics.html.twig', array('rubrics' => $rubrics));
    }

	/**
	 * @Route("/rubrics/create", name="newrubric")
	 * @Template()
	 */
	public function addRubricAction(Request $request){
		$userId = $_COOKIE["uid"];

		$manager = $this->getDoctrine()->getManager();

		$rubric = new Rubric();
		$rubric->setRubric($request->request->get("name"));
		$rubric->setAuthorId($authorId);

		$manager->persist($rubric);
		$manager->flush();

		return $this->render('BlogBundle:Default:rubrics.html.twig');
	}

	/**
	 * @Route("/post/create", name="newpost")
	 * @Template()
	 */
	public function addPostAction(Request $request){
		$authorId = $_COOKIE["uid"];

		$manager = $this->getDoctrine()->getManager();
		$curDate = date("Y-m-j");

		$post = new Post();
		$post->setAuthorId($authorId);
		$post->setRubricId($request->request->get("rubric"));
		$post->setTitle($request->request->get("title"));
		$post->setPreview($request->request->get("preview"));
		$post->setContent($request->request->get("content"));
		$post->setCdate($curDate);

		$manager->persist($post);
		$manager->flush();

		return $this->render('BlogBundle:Default:post.html.twig', array('post' => $post));
	}

	/**
	 * @Route("/post/{postId}", name="newpost")
	 * @Template()
	 */
	public function getPostAction($postId){
		$manager = $this->getDoctrine()->getManager();
		$post = $this->getDoctrine()->getRepository("BlogBundle:blog")->find($id);

		$post->setViews(++$post->getViews());

		$manager->persist($post);
		$manager->flush();

		return $this->render('BlogBundle:Default:post.html.twig', array('post' => $post));
	}

	/**
	 * @Route("/post/edit/{postId}", name="editpost")
	 * @Template()
	 */
	public function editPostAction($postId){		
		$authorId = $_COOKIE["uid"];
		$post = $this->getDoctrine()->getRepository("BlogBundle:blog")->find($id);

		if($post->getAuthorId() != $authorId)
			return $this->render('BlogBundle:Default:post.html.twig', array('postId' => $post->getId()));

		return $this->render('BlogBundle:Default:editpost.html.twig', array('post' => $post));
	}

	/**
	 * @Route("/post/save", name="savepost")
	 * @Template()
	 */
	public function savePostAction(Request $request){
		$postId = $request->request->get("id");

		$manager = $this->getDoctrine()->getManager();
		$post = $this->getDoctrine()->getRepository("BlogBundle:blog")->find($postId);
		$curDate = date("Y-m-j");

		$post = new Post();
		$post->setRubricId($request->request->get("rubric"));
		$post->setTitle($request->request->get("title"));
		$post->setPreview($request->request->get("preview"));
		$post->setContent($request->request->get("content"));
		$post->setEdate($curDate);

		$manager->persist($post);
		$manager->flush();

		return $this->render('BlogBundle:Default:post.html.twig', array('post' => $post));
	}

	/**
	 * @Route("/post/remove/{postId}", name="removepost")
	 * @Template()
	 */
	public function removePostAction($postId){
		$userId = $_COOKIE["uid"];
		$manager = $this->getDoctrine()->getManager();

		$post->setId($postId);
		$manager->remove($post);
		$manager->flush();

		return $this->forward('UserBundle:Default:profile', array('id' => $userId));
	}
}
