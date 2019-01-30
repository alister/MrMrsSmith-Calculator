# Mr & Mrs Smith, Calculator

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

----

Each operation [+. -, /, *, and potentially more] are classes that extend a specific 
interface: `Calculatable`. These are 
then [Tagged by interface, collected and looped over the tagged classes](https://symfony.com/doc/current/service_container/tags.html#reference-tagged-services) 
using the Symfony 'configuration magic', `!tagged tag.name`.
 
Core of the check-act loop:
 
    foreach ($knownOperations as $op) 
        if ($op->matches($operation)) 
            return $op->calculate($params);
 
While there may be more 'elegant' design patterns for this core loop, they can hide 
the core intention, and with a relatively few number of operations that are likely (for the 
simplest case, the four simple arithmetic operators), and even extended to the fullest, there 
would be only a dozen or so useful operations that would be useful in this context.

This loop could also be extended to act as a base for multiple parameters, taking 
the first two items from the list, performing the calculation, and shifting the 
result back onto the start of the parameter list as a stack-like object to perform 
a set of operations. This would be the core of a basic 
[RPN](https://en.wikipedia.org/wiki/Reverse_Polish_notation) mechanism.
