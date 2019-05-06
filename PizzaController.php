<?php
namespace App\Controller;

use App\Entity\Pizzas;
use App\Entity\Toppings;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\Query;

class PizzaController extends AbstractController
{
    public function showAll()
    {
        $arrayPizza = array();
        $counter = 0;

        $pizzas = $this->getDoctrine()
            ->getRepository(Pizzas::class)
            ->findAll();

        if (!$pizzas) {
            return new Response(json_encode('No pizza\'s found'));
        }

        foreach ($pizzas as $pizza) {
            $arrayPizza[$counter]['name'] = $pizza->getName();
            foreach ($pizza->getToppingId() as $topping) {
                $arrayPizza[$counter]['toppings'][] = $topping->getName();
            }
            $counter++;
        }

        $pizzasJson = json_encode($arrayPizza);

        return new Response(
            $pizzasJson
        );
    }

    public function getPizza($name)
    {
        if (Is_Numeric($name)) {
            $pizza = $this->getDoctrine()
                ->getRepository(Pizzas::class)
                ->find($name);

            if (!$pizza) {
                return new Response(json_encode('No pizza found'));
            }

            $pizzaArray = [
                'name' => $pizza->getName(),
            ];

            foreach ($pizza->getToppingId() as $topping) {
                $pizzaArray['toppings'][] = $topping->getName();
            }

            return new Response(
                json_encode($pizzaArray)
            );
        } else {
            $pizza = $this->getDoctrine()
                ->getRepository(Pizzas::class)
                ->findOneBy(['name' => $name]);

            if (!$pizza) {
                return new Response(json_encode('No pizza found'));
            }

            $pizzaArray = [
                'name' => $pizza->getName(),
            ];

            foreach ($pizza->getToppingId() as $topping) {
                $pizzaArray['toppings'][] = $topping->getName();
            }

            return new Response(
                json_encode($pizzaArray)
            );
        }
    }

    public function createPizza($name)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $pizza = new Pizzas();
        $pizza->setName($name);

        $entityManager->persist($pizza);
        $entityManager->flush();

        return new Response(json_encode($name . " pizza was created"));
    }

    public function deletePizza($name)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $pizza = $entityManager->getRepository(Pizzas::class)->findOneBy(['name' => $name]);

        if (!$pizza) {
            return new Response(json_encode('No pizza found'));
        }

        $entityManager->remove($pizza);
        $entityManager->flush();

        return new Response(json_encode($name . " Pizza was deleted"));
    }
	
	public function bakePizza($name)
	{
		$entityManager = $this->getDoctrine()->getManager();
        $pizza = $entityManager->getRepository(Pizzas::class)->findOneBy(['name' => $name]);
		
		if (!$pizza) {
            return new Response(json_encode('No pizza found'));
        }
		
		$pizza->setBaking('true');
		$entityManager->persist($pizza);
        $entityManager->flush();
		
		return new Response(json_encode('baking pizza '.$name));
	}
	
	public function slicePizza($name)
	{
		$entityManager = $this->getDoctrine()->getManager();
        $pizza = $entityManager->getRepository(Pizzas::class)->findOneBy(['name' => $name]);

        if (!$pizza) {
            return new Response(json_encode('No pizza found'));
        }

        $entityManager->remove($pizza);
        $entityManager->flush();

        return new Response(json_encode($name . " Pizza was sliced"));
	}
}
