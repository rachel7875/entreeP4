<?php

use OC\CoreBundle\Entity\Booking;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;
use OC\CoreBundle\Validator\AntiBookingAfterClosingTimeValidator;

class AntiBookingAfterClosingTimeValidatorTest extends ConstraintValidatorTestCase {
    protected function createValidator()
    {
        $mock = $this->getMockBuilder(AntiBookingAfterClosingTimeValidator::class)
            ->disableOriginalConstructor()
            ->setMethods(['getCurrentDate'])
            ->getMock();

        return $mock;
    }

    public function testBeforeClosingTimeLundiShouldNoViolation() {
        $date = new \DateTime('2019-10-14');

        $this->validator
            ->method('getCurrentDate')
            ->willReturn((new \DateTime('2019-10-14'))->setTime(16, 59));

        $this->validator->validate($date, new \OC\CoreBundle\Validator\AntiBookingAfterClosingTime());

        $this->assertNoViolation();
    }

    public function testBeforeClosingTimeMercrediShouldNoViolation() {
        $date = new \DateTime('2019-10-23');

        $this->validator
            ->method('getCurrentDate')
            ->willReturn((new \DateTime('2019-10-23'))->setTime(20, 44));

        $this->validator->validate($date, new \OC\CoreBundle\Validator\AntiBookingAfterClosingTime());

        $this->assertNoViolation();
    }

    public function testBeforeClosingTimeJeudiShouldNoViolation() {
        $date = new \DateTime('2019-10-31');

        $this->validator
            ->method('getCurrentDate')
            ->willReturn((new \DateTime('2019-10-31'))->setTime(16, 59));

        $this->validator->validate($date, new \OC\CoreBundle\Validator\AntiBookingAfterClosingTime());

        $this->assertNoViolation();
    }

    public function testBeforeClosingTimeVendrediShouldNoViolation() {
        $date = new \DateTime('2019-11-08');

        $this->validator
            ->method('getCurrentDate')
            ->willReturn((new \DateTime('2019-11-08'))->setTime(20, 44));

        $this->validator->validate($date, new \OC\CoreBundle\Validator\AntiBookingAfterClosingTime());

        $this->assertNoViolation();
    }

    public function testBeforeClosingTimeSamediShouldNoViolation() {
        $date = new \DateTime('2019-11-16');

        $this->validator
            ->method('getCurrentDate')
            ->willReturn((new \DateTime('2019-11-16'))->setTime(16, 59));

        $this->validator->validate($date, new \OC\CoreBundle\Validator\AntiBookingAfterClosingTime());

        $this->assertNoViolation();
    }


    public function testAfterClosingTimeLundiShouldThrowViolation() {
        $date = new \DateTime('2019-11-18');

        $this->validator
            ->method('getCurrentDate')
            ->willReturn((new \DateTime('2019-11-18'))->setTime(18, 01));

        $this->validator->validate($date, new \OC\CoreBundle\Validator\AntiBookingAfterClosingTime());

        $this->buildViolation('afterClosingTime.msg')
            ->assertRaised();
    }

    public function testAfterClosingTimeMercrediShouldThrowViolation() {
        $date = new \DateTime('2019-11-27');

        $this->validator
            ->method('getCurrentDate')
            ->willReturn((new \DateTime('2019-11-27'))->setTime(20, 46));

        $this->validator->validate($date, new \OC\CoreBundle\Validator\AntiBookingAfterClosingTime());

        $this->buildViolation('afterClosingTime.msg')
            ->assertRaised();
    }

    public function testAfterClosingTimeJeudiShouldThrowViolation() {
        $date = new \DateTime('2019-12-05');

        $this->validator
            ->method('getCurrentDate')
            ->willReturn((new \DateTime('2019-12-05'))->setTime(23, 46));

        $this->validator->validate($date, new \OC\CoreBundle\Validator\AntiBookingAfterClosingTime());

        $this->buildViolation('afterClosingTime.msg')
            ->assertRaised();
    }

    public function testAfterClosingTimeVendrediShouldThrowViolation() {
        $date = new \DateTime('2019-10-18');

        $this->validator
            ->method('getCurrentDate')
            ->willReturn((new \DateTime('2019-10-18'))->setTime(20,46));

        $this->validator->validate($date, new \OC\CoreBundle\Validator\AntiBookingAfterClosingTime());

        $this->buildViolation('afterClosingTime.msg')
            ->assertRaised();
    }

    public function testAfterClosingTimeSamediShouldThrowViolation() {
        $date = new \DateTime('2019-12-14');

        $this->validator
            ->method('getCurrentDate')
            ->willReturn((new \DateTime('2019-12-14'))->setTime(17,01));

        $this->validator->validate($date, new \OC\CoreBundle\Validator\AntiBookingAfterClosingTime());

        $this->buildViolation('afterClosingTime.msg')
            ->assertRaised();
    }
}