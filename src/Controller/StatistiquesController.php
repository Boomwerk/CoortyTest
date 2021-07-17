<?php

namespace App\Controller;

use App\Entity\Breeds;

use App\Entity\Department;
use App\Entity\Poeples;
use App\Repository\BreedsRepository;
use App\Repository\DepartmentRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StatistiquesController extends AbstractController
{
    /**
     * @Route("/statistiques/agemoyenneAnimals/{idCountry}/{idAnimals}", name="statistiques", methods={"GET"})
     */
    public function index($idCountry, $idAnimals ): Response
    {
       
        $products = $this->getDoctrine()->getRepository(Breeds::class)->getAgeMoyenne($idCountry, $idAnimals);
        if(empty($products)){
            return $this->json(["status"=> 400, "message" => "no result"]);
        }
        
        return $this->json(["status" => 200, "ageMoyenneAnimalsInCountry" => $products],200);
    }


    /**
     * @Route("/statistiques/NumbreOfDog/{idDepartment}/{idAge}", name="sum", methods={"GET"})
     */
    public function sum($idDepartment, $idAge): Response
    {
       
        $products = $this->getDoctrine()->getRepository(Department::class)->getSum($idDepartment, $idAge);
       
       
        if(empty($products)){
            return $this->json(["status"=> 400, "message" => "no result"]);
        }
        
        return $this->json(["status" => 200, "numberOfDog" => $products],200);
    }

    /**
     * @Route("/statistiques/topAnimalsCountry/{country}/{animals}", name="top", methods={"GET"})
     */
    public function top($country, $animals ): Response
    {
       
        $products = $this->getDoctrine()->getRepository(Poeples::class)->getTop($country, $animals);

        if(empty($products)){
            return $this->json(["status"=> 400, "message" => "no result"]);
        }
        
        return $this->json(["status" => 200, "top3Animals" => $products],200);
    }
}
