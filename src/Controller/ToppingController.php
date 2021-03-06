<?php
namespace App\Controller;

use App\Entity\Pizzas;
use App\Entity\Toppings;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\Query;

class ToppingController extends AbstractController
{
    public function showAll()
    {
        $toppings = $this->getDoctrine()
            ->getRepository(Toppings::class)
            ->findAll();

        if (!$toppings) {
            return new Response(json_encode('No toppings found'));
        }

        foreach ($toppings as $topping) {
            $arrayTopping[] = $topping->getName();
        }

        $toppingJson = json_encode($arrayTopping);

        return new Response(
            $toppingJson
        );
    }

    public function createTopping($name, Request $request)
    {
        $pizzaName = $request->get('pizzaName');
        $entityManager = $this->getDoctrine()->getManager();

        $pizza = $this->getDoctrine()
            ->getRepository(Pizzas::class)
            ->findOneBy(['name' => $pizzaName]);

        if (!$pizza) {
            return new Response(json_encode('No pizza found'));
        }
		
		if ($pizza->getBaking() == 1){
			return new Response(json_encode('Pizza is already baking'));
		}

        if ($pizza->getSliced() == 1){
            return new Response(json_encode('Pizza is already sliced'));
        }

        $topping = $this->getDoctrine()
            ->getRepository(Toppings::class)
            ->findOneBy(['name' => $name]);

        if (!$topping) {
            $topping = new Toppings();
            $topping->setName($name);

            $entityManager->persist($topping);
            $entityManager->flush();

            $topping = $this->getDoctrine()
                ->getRepository(Toppings::class)
                ->findOneBy(['name' => $name]);
        }

        $topping->addToppingId($pizza);

        $entityManager->persist($topping);
        $entityManager->flush();

        return new Response(json_encode($name . " topping was added to " . $pizzaName));
    }

    public function deleteTopping($name, Request $request)
    {
        $pizzaName = $request->get('pizzaName');
        $entityManager = $this->getDoctrine()->getManager();
        $topping = $entityManager->getRepository(Toppings::class)->findOneBy(['name' => $name]);
        $pizza = $entityManager->getRepository(Pizzas::class)->findOneBy(['name' => $pizzaName]);

        if (!$topping) {
            return new Response(json_encode('No topping found with the name: '. $name));
        }

        if (!$pizza) {
            return new Response(json_encode('No pizza found with the name: '. $pizzaName));
        }
		
		if ($pizza->getBaking() == 1){
			return new Response(json_encode('Pizza is already baking'));
		}

        if ($pizza->getSliced() == 1){
            return new Response(json_encode('Pizza is already sliced'));
        }

        $pizza->removeToppingId($topping);

        $entityManager->persist($pizza);
        $entityManager->flush();

//        if (!$topping->getToppingId()) {
//            $entityManager->remove($topping);
//            $entityManager->flush();
//        }

        return new Response(json_encode($name . " topping was deleted from the pizza: " . $pizzaName));
    }
}
