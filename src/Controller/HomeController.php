<?php

namespace App\Controller;

use App\Entity\Breeds;
use App\Entity\Animals;
use App\Entity\Country;
use App\Entity\Poeples;
use App\Entity\Department;
use App\Repository\BreedsRepository;
use App\Repository\AnimalsRepository;
use App\Repository\CountryRepository;
use App\Repository\PoeplesRepository;
use App\Repository\DepartmentRepository;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\Constraint\Count;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\Exception\NotNormalizableValueException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home", methods={"GET"})
     */
    public function index( DepartmentRepository $departmentRepo): Response
    {
        return $this->json($departmentRepo->findAll(), 200,[], ['groups' => "read" ]);
    }

    /**
     * @Route("/select/{route}", name="select", methods={"GET"})
     */
    public function select($route, AnimalsRepository $animal, BreedsRepository $breeds,CountryRepository $country, PoeplesRepository $peoples, DepartmentRepository $department){

        if($route == 'animals'){
           $result = $animal->findAll();
        }
        else if($route == 'breeds'){
            $result = $breeds->findAll();
        }
        else if($route == 'country'){
            $result = $country->findAll();
        }
        else if($route == 'peoples'){
            $result = $peoples->findAll();
        }
        else if($route == 'department'){
            $result = $department->findAll();
        }
        else{
            return $this->json(["message" => "la page n'existe pas"], 404);
        }

        return $this->json($result,200,[],['groups'=>["one"]]);

    }

    /**
     * @Route("/select/{route}/{id}", name="selectOne", methods={"GET"})
     */
    public function selectOne($route, $id, AnimalsRepository $animal, BreedsRepository $breeds,CountryRepository $country, PoeplesRepository $peoples, DepartmentRepository $department){

        if($route == 'animals'){
           $result = $animal->find($id);
        }
        else if($route == 'breeds'){
            $result = $breeds->find($id);
        }
        else if($route == 'country'){
            $result = $country->find($id);
        }
        else if($route == 'peoples'){
            $result = $peoples->find($id);
        }
        else if($route == 'department'){
            $result = $department->find($id);
        }
        else{
            return $this->json(["message" => "la page n'existe pas"], 404);
        }

        return $this->json($result,200,[],['groups'=>["one"]]);

    }


     /**
     * @Route("/add/{route}", name="add", methods={"GET","POST"})
     */
    public function add($route, Request $request, SerializerInterface $serializer, EntityManagerInterface $manager, ValidatorInterface $validator){

        if($route == 'animals'){
            $class = Animals::class;
        }
        else if($route == 'breeds'){
            
            $class = Breeds::class;
        }
        else if($route == 'country'){
            
            $class = Country::class;
        }
        else if($route == 'peoples'){
            
            $class = Poeples::class;
        }
        else if($route == 'department'){
            
            $class = Department::class;
        }
        else{
            return $this->json(["message" => "la page n'existe pas"], 404);
        }

        $req = $request->getContent();

        try{

            $deserialize = $serializer->deserialize($req, $class, 'json');

            $errors = $validator->validate($deserialize);

            if(count($errors) > 0 ){
                return $this->json($errors, 400);
            }

            $manager->persist($deserialize);
            $manager->flush();

        }catch(NotEncodableValueException | NotNormalizableValueException $e){

            return $this->json(["status" => 400, "message" => $e->getMessage()]);
        }

        return $this->json(["status" => 201, "message"=>$deserialize],201,[],['groups'=>["one"]]);


    }


    /**
     * @Route("/update/{route}/{id}", name="update", methods={"GET","PUT"})
     */
    public function update($route,$id,Request $request, SerializerInterface $serializer, EntityManagerInterface $manager, ValidatorInterface $validator){
        $clientData = json_decode($request->getContent());

        if($route == 'animals'){
            
            $data = $manager->getRepository(Animals::class)->find($id);
            $data->setNameAnimals($clientData->nameAnimals);
            $data->setNameAnimals($clientData->imgAnimals);
        }
        else if($route == 'breeds'){
            
            $data = $manager->getRepository(Breeds::class)->find($id);

            $data->setNameBreed($clientData->nameBreed);
            $data->setSizeBreed($clientData->sizeBreed);
            $data->setAgeBreed($clientData->ageBreed);
            $data->setImgAnimal($clientData->imgAnimal);
        }
        else if($route == 'country'){
            
            $data = $manager->getRepository(Country::class)->find($id);
            $data->setCountryName($clientData->countryName);
            $data->setCountryImg($clientData->countryImg);

        }
        else if($route == 'peoples'){
            
            $data = $manager->getRepository(Poeples::class)->find($id);
            $data->setNumberPeople($clientData->numberPoeple);
        }
        else if($route == 'department'){
            
           
            $instance = $manager->getRepository(Department::class)->find($id);
            $instance->setNameDepartment($clientData->nameDepartment);
            $instance->setImgDepartment($clientData->imgDepartment);
        }
        else{
            return $this->json(["message" => "la page n'existe pas"], 404);
        }

        
        $error = $validator->validate($data);

        if(count($error) > 0) {
            return $this->json($error, 400);
        }
       
        $manager->flush();

        return $this->json(["status"=> 201, "message"=> "update succeful"]);
        
    }
    
    /**
     * @Route("/delete/{route}/{id}", name="delete", methods={"GET","DELETE"})
     */

    public function delete($route, $id, EntityManagerInterface $manager){
        

        if($route == 'animals'){
            $data = $manager->getRepository(Animals::class)->find($id);
        }
        else if($route == 'breeds'){
            
            $data = $manager->getRepository(Breeds::class)->find($id);
        }
        else if($route == 'country'){
            
            $data = $manager->getRepository(Country::class)->find($id);
        }
        else if($route == 'peoples'){
            
            $data = $manager->getRepository(Poeples::class)->find($id);
        }
        else if($route == 'department'){
            
            $data = $manager->getRepository(Department::class)->find($id);
        }
        else{
            return $this->json(["message" => "la page n'existe pas"], 404);
        }

        $manager->remove($data);
        $manager->flush();

        return $this->json(["status"=> 201, "message"=>"delete succeful"], 201);


    }





    

    
}
