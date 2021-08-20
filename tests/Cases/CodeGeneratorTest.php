<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace HyperfTest\Cases;

use Doctrine\Common\Annotations\AnnotationReader;
use Hyperf\CodeGenerator\Ast;
use Hyperf\CodeGenerator\CodeGenerator;
use HyperfTest\Stub\Attribute;
use HyperfTest\Stub\TestAttribute;
use ReflectionClass;
use ReflectionProperty;

/**
 * @internal
 * @coversNothing
 */
class CodeGeneratorTest extends AbstractTestCase
{
    public function testRewriteClass(): void
    {
        $test = $this->makeTestClass();
        $sample = new ReflectionClass(Attribute::class);
        $this->assertEquals($test->getParentClass(), $sample->getParentClass());
        $this->assertEquals($test->getDocComment(),$sample->getDocComment());
        foreach ($test->getProperties() as $testProperty) {
            $this->assertTrue($sample->hasProperty($testProperty->name));
            $this->assertEquals($testProperty->hasType(),$testProperty->hasType());
            if($testProperty->hasType()) {
                $this->assertEquals($testProperty->getType(), $testProperty->getType());
            }
            $sampleProperty = $sample->getProperty($testProperty->name);
            $testAttributes = $testProperty->getAttributes();
            $sampleAttributes = $sampleProperty->getAttributes();
            for ($index = 0, $indexMax = count($testAttributes);$index < $indexMax;$index ++) {
                $this->assertAnnotationAttribute($testAttributes[$index],$sampleAttributes[$index]);
            }
        }
        foreach ($test->getMethods() as $testMethod) {
            $this->assertTrue($sample->hasMethod($testMethod->name));
            $sampleMethod = $sample->getMethod($test->name);
            $testAttributes = $testMethod->getAttributes();
            $sampleAttributes = $sampleMethod->getAttributes();
            for ($index = 0, $indexMax = count($testAttributes);$index < $indexMax;$index ++) {
                $this->assertAnnotationAttribute($testAttributes[$index],$sampleAttributes[$index]);
            }
            $this->assertEquals($testMethod->getAttributes(),$sampleMethod->getAttributes());
        }
    }

    protected function makeTestClass() :ReflectionClass
    {
        $generator = new CodeGenerator(new Ast(new AnnotationReader()));
        $code = $generator->generate(file_get_contents(__DIR__ . '/../Stub/Test.php'));
        file_put_contents(__DIR__ . '/../Stub/TestAttribute.php',str_replace('class Test','class TestAttribute',$code));
        return new ReflectionClass(TestAttribute::class);
    }

    protected function assertAnnotationAttribute($test,$sample) :void
    {
        $class = new ReflectionClass($test);
        foreach ($class->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
            $this->assertEquals($property->getValue($test),$property->getValue($sample));
        }
    }
}
