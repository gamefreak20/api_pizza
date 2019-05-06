# api_pizza
                                              
>Route: /pizzas               
>Method: GET       
>SendData: null                              
>Info: Get all the pizza's and toppings of it<br>
---
>Route: /pizzas/{name}        
>Method: GET       
>SendData: null                              
>Info: Get the pizza and toppings with this name<br>
---
>Route: /pizzas/{name}        
>Method: POST      
>SendData: null                              
>Info: Create a empty pizza without toppings with this name<br>
---
>Route: /pizzas/{name}        
>Method: DELETE    
>SendData: null                              
>Info: Remove the pizza with this name<br>
---
>Route: /pizzas/bake/{name}   
>Method: POST      
>SendData: null                              
>Info: Bake the pizza with this name, when baking you will not beable to add/remove toppings of this pizza<br>
---
>Route: /pizzas/slice/{name}  
>Method: POST      
>SendData: null                              
>Info: Slice the pizza with this name, when sliced the pizza will be removed from the database<br>
---
>Route: /toppings             
>Method: GET       
>SendData: null                              
>Info: Get all the toppings that are used in the pizza's<br>
---
>Route: /toppings/{name}      
>Method: POST      
>SendData: ['pizzaName' => 'yourPizzaName']  
>Info: Add a topping({name}) to the pizza 'yourPizzaName'   <br> 
---
>Route: /toppings/{name}      
>Method: DELETE    
>SendData: ['pizzaName' => 'yourPizzaName']  
>Info: Remove a topping({name}) from 'yourPizzaName'<br>
