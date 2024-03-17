<?php

declare(strict_types=1);

/*
 * This file is part of the CMS Health Project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the MIT License.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Cfhack\CmsHealth\Tests\Unit\Reference;

use Cfhack\CmsHealth\CheckInterface;
use Cfhack\CmsHealth\Reference\Check;
use Cfhack\CmsHealth\Reference\ComponentType;
use Cfhack\CmsHealth\Reference\Status;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class CheckTest extends TestCase
{
    #[Test]
    public function checkImplementsInterface(): void
    {
        $subject = $this->createSubject();
        self::assertInstanceOf(CheckInterface::class, $subject);
    }

    #[Test]
    public function propertyIdentifierReturnsConstructorValue(): void
    {
        $subject = $this->createSubject();
        self::assertSame('tester:check', $subject->identifier);
    }

    #[Test]
    public function getIdentifierReturnsConstructorValue(): void
    {
        $subject = $this->createSubject();
        self::assertSame('tester:check', $subject->getIdentifier());
    }

    #[Test]
    public function propertyComponentIdReturnsConstructorValue(): void
    {
        $subject = $this->createSubject();
        self::assertSame('component-id', $subject->componentId);
    }

    #[Test]
    public function getComponentIdReturnsConstructorValue(): void
    {
        $subject = $this->createSubject();
        self::assertSame('component-id', $subject->getComponentId());
    }

    #[Test]
    public function propertyComponentTypeReturnsConstructorValue(): void
    {
        $subject = $this->createSubject();
        self::assertSame(ComponentType::System, $subject->componentType);
    }

    #[Test]
    public function getComponentTypeReturnsConstructorValue(): void
    {
        $subject = $this->createSubject();
        self::assertSame(ComponentType::System->value, $subject->getComponentType());
    }

    #[Test]
    public function propertyStatusReturnsConstructorValue(): void
    {
        $subject = $this->createSubject();
        self::assertSame(Status::Pass, $subject->status);
    }

    #[Test]
    public function getStatusReturnsConstructorValue(): void
    {
        $subject = $this->createSubject();
        self::assertSame(Status::Pass->value, $subject->getStatus());
    }

    #[Test]
    public function propertyObservedValueReturnsConstructorValue(): void
    {
        $subject = $this->createSubject();
        self::assertSame('1', $subject->observedValue);
    }

    #[Test]
    public function getObservedValueReturnsConstructorValue(): void
    {
        $subject = $this->createSubject();
        self::assertSame('1', $subject->getObservedValue());
    }

    #[Test]
    public function propertyObservedUnitReturnsConstructorValue(): void
    {
        $subject = $this->createSubject();
        self::assertSame('unit', $subject->observedUnit);
    }

    #[Test]
    public function getObservedUnitReturnsConstructorValue(): void
    {
        $subject = $this->createSubject();
        self::assertSame('unit', $subject->getObservedUnit());
    }

    #[Test]
    public function propertyOutputReturnsConstructorValue(): void
    {
        $subject = $this->createSubject();
        self::assertSame('some-output', $subject->output);
    }

    #[Test]
    public function getOutputReturnsConstructorValue(): void
    {
        $subject = $this->createSubject();
        self::assertSame('some-output', $subject->getOutput());
    }

    #[Test]
    public function propertyTimeReturnsConstructorValue(): void
    {
        $dateTime = \DateTime::createFromFormat('Y-m-d\TH:i:sP', '2024-03-16T12:34:56+00:00');
        $subject = $this->createSubject();
        self::assertSame($dateTime->getTimestamp(), $subject->time->getTimestamp());
    }

    #[Test]
    public function getTimeReturnsConstructorValue(): void
    {
        $subject = $this->createSubject();
        self::assertSame('2024-03-16T12:34:56+00:00', $subject->getTime());
    }

    private function createSubject(
        string $identifier = 'tester:check',
        string $componentId = 'component-id',
        ComponentType $componentType = ComponentType::System,
        Status $status = Status::Pass,
        string $observedValue = '1',
        string $observedUnit = 'unit',
        string $output = 'some-output',
        \DateTime $time = null,
    ): Check {
        $time ??= \DateTime::createFromFormat('Y-m-d\TH:i:sP', '2024-03-16T12:34:56+00:00');
        return new Check(
            $identifier,
            $componentId,
            $componentType,
            $status,
            $observedValue,
            $observedUnit,
            $output,
            $time,
        );
    }
}
