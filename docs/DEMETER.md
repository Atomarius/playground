# Law of Demeter

> Mockist testers do talk more about avoiding 'train wrecks' - method chains of style of getThis().getThat().getTheOther(). Avoiding method chains is also known as following the Law of Demeter. While method chains are a smell, the opposite problem of middle men objects bloated with forwarding methods is also a smell. (I've always felt I'd be more comfortable with the Law of Demeter if it were called the Suggestion of Demeter.) - Martin Fowler, [Mocks Aren't Stubs](http://martinfowler.com/articles/mocksArentStubs.html)


``` java
    public void plotDate(Date aDate, Selection aSelection) {
        TimeZone tz = aSelection.getRecorder().getLocation().getTimeZone();
        ...
    }
```

``` java
    public void plotDate(Date aDate, TimeZone aTz) {
        ...
    }
    plotDate(someDate, someSelection.getTimeZone());
```

``` php
class Demeter
{
    /** @var A */
    private $a;

    /** @return int */
    private function func(){}

    /** @param B $b */
    public function example(B $b)
    {
        $c = new C();
        $f = $this->func(); // itself

        $b->invert(); // any parameters that were passed into the method

        $c->execute(); // any object it created

        $this->a->setActive(); // any directly held component objects
    }
}
```
