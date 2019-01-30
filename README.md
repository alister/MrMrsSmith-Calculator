# Mr & Mrs Smith, Calculator
## Final notes.

It's a fun little piece of code, and I spend a few hours on it all told because I was enjoying it. I also took the opportunity to use auto-tagging based on a class, and then auto-config to pull that list of tagged services in for use as the operations (addition, subtraction, etc)- this allows for new operators without **any** configuration. This is how the multiplication and division were added, only needing a few trivial methods in the two new classes - and taking just a couple of minutes for them both.  I have previously done this (from code I wrote for [SncRedis](https://github.com/snc/SncRedisBundle/pull/242)) with a formal [compiler pass](https://phpscaling.com/2017/09/27/sncredis-and-tagged-services/). 

If you renamed `src/Calculator/Operations/Division.php` to (for example) *.phpx, so that the services.yaml file would not pick it up, that operator would disappear from the options, similarly, adding another operator (eg, exponent, '**') is a single simple class. One such sample is included to rename to a simple .php file - `src/Calculator/Operations/Exponent.php-RENAME-ME`.

There is no validation, just the use of NumberType in the form, but the paramaters to the calculation are input as plain `<input type=text>`. Nor are there any checks for division by zero, for example. 

The data-model, use by the form, explicitly does not define parameter or return types, and so integers and floats are permitted in the calculations. This was a deliberate choice. 

I did pull Bootstrap CSS & JS into the base template (and an example Bootstrap page around it), and set the Symfony form theme, but the widgets are very simple within the form itself, being presented as just a few block-wide inputs, with the operator as a choice-box. As per best-practice, the submit button is plain HTML within the template, and not defined in code.

Finally, there are only a couple of simple tests - a dataprovider checks that the addition works as expected. One that could have been usefully added would be to get the `App\Calculator\OperatorList` object from the container and ensure that it was picking up the auto-tagged services that perform the actual calculations.


----

Each operation [+. -, /, *, and potentially more] are classes that extend a specific 
interface: `Calculatable`. These are 
then [Tagged by interface, and injected into a service](https://symfony.com/doc/current/service_container/tags.html#reference-tagged-services) 
using the Symfony 'configuration magic', `!tagged tag.name`.
 
Core of the check-act loop:
 
    $operation = $form->getData()->getOperation();  // (+-/* choice from form)
    
    foreach ($knownOperations as $opName => $op) 
        if ($op->matches($operation))  
            return $op->calculate(/* params from form */);
 
While there may be more 'elegant' design patterns for this core loop, they can hide 
the core intention, and with a relatively few number of operations that are likely (for the 
simplest case, the four simple arithmetic operators), and even extended to the fullest, there 
would be only a dozen or so useful operations that would be useful in this context.

This loop could also be extended to act as a base for multiple parameters, taking 
the first two items from the list, performing the calculation, and shifting the 
result back onto the start of the parameter list as a stack-like object to perform 
a set of operations. This would be the core of a basic 
[RPN](https://en.wikipedia.org/wiki/Reverse_Polish_notation) mechanism.

---

Using the latest version of Symfony (http://symfony.com/doc/current/setup.html)
create a simple calculator that can handle the following calculation types: plus,
minus, multiplication, division.

It is up to you if you prefer to use annotations, yaml or xml configuration.
Your code should at least include a route to access the calculator page (e.g.
/calculator), a controller to render the template and a very basic template for the
form.

We are not looking for a pretty web page with lots of Javascript and CSS - a basic
layout that works and uses best practises will gain more points.

On form submit, your page should show the result of the calculation.

While great knowledge of Symfony would be an advantage we are mainly look for
best coding styles (we use PSR-2 but we accept anything that is consistent and
clean) and practices. You don’t have to put bells and whistles on unless you want to.

Please upload your code to github.com or alike and provide us with a link.

This task should take no longer than 90 minutes.
