<?php
/**
 * Created by PhpStorm.
 * User: Shareed2k
 * Date: 5/20/14
 * Time: 9:43 PM
 */

namespace Screenfony\DemoBundle\Controller;


use FOS\RestBundle\Request\ParamFetcher;
use Screenfony\DemoBundle\Entity\User;
use Screenfony\DemoBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UsersController extends Controller {

    /**
     * @param Request $req
     * @return array
     * @View()
     */
    public function getUsersAction(Request $req){

        if($this->apiKeyCheck()){
            $users = $this->getDoctrine()->getRepository('ScreenfonyDemoBundle:User')
                ->findAll();
            return array('users' => $users);
        }

        $errStr = json_encode(array('error' => 'API Key could not be validated'));
        return Response::create($errStr, 401);
    }

    /**
     * @param User $user
     * @return array
     * @View()
     * @ParamConverter("user", class="ScreenfonyDemoBundle:User")
     *
     */
    public function getUserAction(User $user){
        if($this->apiKeyCheck()){
            return array('user' => $user);
        }

        $errStr = json_encode(array('error' => 'API Key could not be validated'));
        return Response::create($errStr, 401);
    }

    /**
     * Post action
     * @var Request $request
     * @return View|array
     * @View()
     */
    public function postCreateUserAction(Request $request){

        if($this->apiKeyCheck()){

            $entity = new User();
            $form = $this->createForm(new UserType(), $entity);
            $form->submit($request);

            if($form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();

                /*return $this->redirect(
                    $this->generateUrl('get_user', array(
                        'user' => $entity->getId()
                    )),
                    201
                );*/

                $errStr = json_encode(array('success' => 'user was created.'));
                return Response::create($errStr, 201);
            }
        }

        $errStr = json_encode(array('error' => 'API Key could not be validated'));
        return Response::create($errStr, 401);
    }

    /**
     * identify by API specified key
     * @return bool
     */
    private function apiKeyCheck(){
        $apiKey = $this->get('request_stack')->getCurrentRequest()->headers->get('apiKey');
        $serverKey = $this->getDoctrine()->getRepository('ScreenfonyDemoBundle:Token')
            ->findBy(array('apiKey' => $apiKey));

        if($serverKey){
            return true;
        }

        return false;
    }
} 