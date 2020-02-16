<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Contact;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Artem Oliynyk, <artem@readmire.com>
 * Date: 16/02/20
 */
class TestDataFixtures implements FixtureInterface
{
    /**
     * @var string[]
     */
    private $firstnames;

    /**
     * @var string[]
     */
    private $lastnames;

    /**
     * @var string[]
     */
    private $countries;

    /**
     * @var string[]
     */
    private $cities;

    /**
     * @var string[]
     */
    private $streets;

    public function __construct()
    {
        $this->firstnames = [
            'Noah',
            'Liam',
            'Jackson',
            'Lucas',
            'Logan',
            'Benjamin',
            'Jacob',
            'William',
            'Oliver',
            'James',
            'Olivia',
            'Emma',
            'Charlotte',
            'Sophia',
            'Aria',
            'Ava',
            'Chloe',
            'Zoey',
            'Abigail',
            'Amilia',
            'Francesco',
            'Alessandro',
            'Mattia',
            'Lorenzo',
            'Leonardo',
            'Andrea',
            'Gabriele',
            'Matteo',
            'Tommaso',
            'Riccardo',
        ];

        $this->lastnames = [
            'Smith',
            'Johnson',
            'Williams',
            'Brown',
            'Jones',
            'Miller',
            'Davis',
            'Garcia',
            'Rodriguez',
            'Wilson',
            'Martinez',
            'Anderson',
            'Taylor',
            'Thomas',
            'Hernandez',
            'Moore',
            'Martin',
            'Jackson',
            'Thompson',
            'White',
            'Lopez',
            'Lee',
            'Gonzalez',
            'Harris',
            'Clark',
            'Lewis',
            'Robinson',
            'Walker',
        ];

        $this->countries = [
            'Argentina',
            'Australia',
            'Brazil',
            'Canada',
            'China',
            'France',
            'Germany',
            'India',
            'Indonesia',
            'Italy',
            'Japan',
            'Mexico',
            'Russia',
            'Saudi Arabia',
            'South Africa',
            'South Korea',
            'Turkey',
            'United Kingdom',
            'United States',
        ];

        $this->cities = [
            'Starrywall',
            'Whiteton',
            'Icecastle',
            'Icedell',
            'Bymount',
            'Violetlake',
            'Goldvale',
            'Lightedge',
            'Southwall',
            'Starryhollow',
            'Highvale',
            'Marblemount',
            'Lightvale',
            'Riverdell',
            'Clearwolf',
            'Faygate',
            'Starryfox',
            'Riverlake',
            'Norcrest',
            'Snowfog',
            'Aellake',
            'Dragondell',
            'Moorwald',
            'Orlake',
            'Greyflower',
            'Valmoor',
        ];

        $this->streets = [
            'Lane',
            'Ave.',
            'Str.',
            'End',
            'Square',
            'Loop',
        ];
    }

    public function load(ObjectManager $manager)
    {
        $userToCreate = 50;
        for ($i = 1; $i <= $userToCreate; $i++) {

            $firstnameID = array_rand($this->firstnames, 1);
            $firstname = $this->firstnames[$firstnameID];

            $lastnameID = array_rand($this->lastnames, 1);
            $lastname = $this->lastnames[$lastnameID];

            $countryID = array_rand($this->countries, 1);
            $country = $this->countries[$countryID];

            $cityID = array_rand($this->cities, 1);
            $city = $this->cities[$cityID];

            $postcode = strtoupper(substr(md5(microtime(true)), 1, rand(5, 9)));
            $phone = (rand(0, 1) ? '+' : '').crc32(microtime());


            $strCityID = array_rand($this->cities, 1);
            $strStrID = array_rand($this->streets, 1);
            $street = $this->cities[$strCityID].' '.$this->streets[$strStrID].rand(1, 100);

            if (rand(0, 1)) {
                $street .= ", block ".rand(1, 500);;
            }

            $day = rand(1, 28);
            $month = rand(1, 12);
            $year = rand(1950, 2002);

            $bday = new \DateTime("{$year}-{$month}-{$day}");

            $email = strtolower("{$firstname}.{$lastname}@example.com");

            $contact = new Contact();
            $contact->setFirstname($firstname);
            $contact->setLastname($lastname);
            $contact->setCountry($country);
            $contact->setCity($city);
            $contact->setPostcode($postcode);
            $contact->setStreet($street);
            $contact->setPhone($phone);
            $contact->setBirthday($bday);
            $contact->setEmail($email);

            $manager->persist($contact);
        }

        $manager->flush();
    }
}