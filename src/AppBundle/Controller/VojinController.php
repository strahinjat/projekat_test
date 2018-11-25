<?php

namespace AppBundle\Controller;

use http\Env\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;



/**
 * @Route("/vojin")
 */
class VojinController extends Controller
{
    /**
     * @Route("/v1", name="v1")
     */
    public function v1Action(Request $request)
    {
        $json = file_get_contents("/home/qwe/object.json");
        $jsonIterator = new \RecursiveIteratorIterator(
            new \RecursiveArrayIterator(json_decode($json, TRUE)),
            \RecursiveIteratorIterator::SELF_FIRST);
        $dva = json_decode($json, true);

        foreach ($jsonIterator as $key => $val) {
            if(is_array($val)) {
                echo "$key:<br>";
            } else {
                echo "$key => $val<br>";
            }
        }

        var_dump($dva);
        return $this->render('vojin/v1.html.twig');
    }


    /**
     * @Route("/v2", name="v2")
     */
    public function v2Action(Request $request)
    {
        $em= $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:Users')->find(1);
        $user1 = $em->getRepository('AppBundle:Users')->findAll();
        $user2 = $em->getRepository('AppBundle:Users')->findBy(array('email' => 'tylerray54@gmail.com'));

        //var_dump($user2);die;

        // replace this example code with whatever you need
        return $this->render('vojin/v2.html.twig');
    }

    /**
     * @Route("/v3/{id}", name="v3")
     */
    public function v3Action(Request $request, $id)
    {
        $em= $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:Users')->find($id);

        $respone = $this->render('vojin/v3.html.twig', [
            'user' => $user
        ]);
        $request = new \Symfony\Component\HttpFoundation\Response($respone, 200 ,['Content-Type' => 'text/html']);
        return $request;
    }


}
