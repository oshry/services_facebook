<?php

require_once 'UnitTestCommon.php';

class Services_Facebook_UsersTest extends Services_Facebook_UnitTestCommon
{

    public function testIsAppAdded()
    {
        $response = <<<XML
<?xml version="1.0" encoding="UTF-8"?><users_isAppUser_response xmlns="http://api.facebook.com/1.0/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://api.facebook.com/1.0/ http://api.facebook.com/1.0/facebook.xsd">1</users_isAppUser_response>
XML;

        $this->mockSendRequest($response);
        $this->instance->sessionKey = '123123sfsdf-123123';
        $this->assertTrue($this->instance->isAppAdded());
    }

    public function testIsAppUser()
    {
        $response = <<<XML
<?xml version="1.0" encoding="UTF-8"?><users_isAppUser_response xmlns="http://api.facebook.com/1.0/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://api.facebook.com/1.0/ http://api.facebook.com/1.0/facebook.xsd">1</users_isAppUser_response>
XML;

        $this->mockSendRequest($response);
        $this->instance->sessionKey = '123123sfsdf-123123';
        $this->assertTrue($this->instance->isAppUser());
        $this->assertTrue($this->instance->isAppUser(1337));
    }

    public function testSetStatus()
    {
        $response = <<<XML
<?xml version="1.0" encoding="UTF-8"?> <users_setStatus_response xmlns="http://api.facebook.com/1.0/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://api.facebook.com/1.0/ http://api.facebook.com/1.0/facebook.xsd">1</users_setStatus_response>
XML;

        $this->mockSendRequest($response);
        $this->instance->sessionKey = '123123sfsdf-123123';
        $this->assertTrue($this->instance->setStatus('foo'));
        $this->assertTrue($this->instance->setStatus(true));
    }

    public function testGetInfo()
    {
        $response = <<<XML
<?xml version="1.0" encoding="UTF-8"?> <users_getInfo_response xmlns="http://api.facebook.com/1.0/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://api.facebook.com/1.0/ http://api.facebook.com/1.0/facebook.xsd" list="true"> <user> <uid>8055</uid> <about_me>This field perpetuates the glorification of the ego. Also, it has a character limit.</about_me> <activities>Here: facebook, etc. There: Glee Club, a capella, teaching.</activities> <affiliations list="true"> <affiliation> <nid>50453093</nid> <name>Facebook Developers</name> <type>work</type> <status/> <year/> </affiliation> </affiliations> <birthday>November 3</birthday> <books>The Brothers K, GEB, Ken Wilber, Zen and the Art, Fitzgerald, The Emporer's New Mind, The Wonderful Story of Henry Sugar</books> <current_location> <city>Palo Alto</city> <state>CA</state> <country>United States</country> <zip>94303</zip> </current_location> <education_history list="true"> <education_info> <name>Harvard</name> <year>2003</year> <concentrations list="true"> <concentration>Applied Mathematics</concentration> <concentration>Computer Science</concentration> </concentrations> </education_info> </education_history> <first_name>Dave</first_name> <hometown_location> <city>York</city> <state>PA</state> <country>United States</country> </hometown_location> <hs_info> <hs1_name>Central York High School</hs1_name> <hs2_name/> <grad_year>1999</grad_year> <hs1_id>21846</hs1_id> <hs2_id>0</hs2_id> </hs_info> <is_app_user>1</is_app_user> <has_added_app>1</has_added_app> <interests>coffee, computers, the funny, architecture, code breaking,snowboarding, philosophy, soccer, talking to strangers</interests> <last_name>Fetterman</last_name> <locale>en_US</locale> <meeting_for list="true"> <seeking>Friendship</seeking> </meeting_for> <meeting_sex list="true"> <sex>female</sex> </meeting_sex> <movies>Tommy Boy, Billy Madison, Fight Club, Dirty Work, Meet the Parents, My Blue Heaven, Office Space </movies> <music>New Found Glory, Daft Punk, Weezer, The Crystal Method, Rage, the KLF, Green Day, Live, Coldplay, Panic at the Disco, Family Force 5</music> <name>Dave Fetterman</name> <notes_count>0</notes_count> <pic>http://photos-055.facebook.com/ip007/profile3/1271/65/s8055_39735.jpg</pic> <pic_big>http://photos-055.facebook.com/ip007/profile3/1271/65/n8055_39735.jpg</pic_big> <pic_small>http://photos-055.facebook.com/ip007/profile3/1271/65/t8055_39735.jpg</pic_small> <pic_square>http://photos-055.facebook.com/ip007/profile3/1271/65/q8055_39735.jpg</pic_square> <political>Moderate</political> <profile_update_time>1170414620</profile_update_time> <quotes/> <relationship_status>In a Relationship</relationship_status> <religion/> <sex>male</sex> <significant_other_id xsi:nil="true"/> <status> <message>Fast Company, November issue, page 84</message> <time>1193075616</time> </status> <timezone>-8</timezone> <tv>cf. Bob Trahan</tv> <wall_count>121</wall_count> <work_history list="true"> <work_info> <location> <city>Palo Alto</city> <state>CA</state> <country>United States</country> </location> <company_name>Facebook</company_name> <position>Software Engineer</position> <description>Tech Lead, Facebook Platform</description> <start_date>2006-01</start_date> <end_date/> </work_info> </work_history> </user> </users_getInfo_response>
XML;
        $this->mockSendRequest($response);
        $result = $this->instance->getInfo(231312);
        $this->assertType('SimpleXMLElement', $result);
        $this->assertObjectHasAttribute('user', $result);
    }

    public function testGetLoggedInUser()
    {
        $response = <<<XML
<?xml version="1.0" encoding="UTF-8"?> <users_getLoggedInUser_response xmlns="http://api.facebook.com/1.0/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://api.facebook.com/1.0/ http://api.facebook.com/1.0/facebook.xsd" list="true">1240077</users_getLoggedInUser_response>
XML;

        $this->mockSendRequest($response);
        $this->assertEquals(1240077, $this->instance->getLoggedInUser());
    }

    public function testHasAppPermission()
    {
        $response = <<<XML
<?xml version="1.0" encoding="UTF-8"?> <users_hasAppPermission_response xmlns="http://api.facebook.com/1.0/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://api.facebook.com/1.0/ http://api.facebook.com/1.0/facebook.xsd">1</users_hasAppPermission_response>
XML;

        $this->mockSendRequest($response);
        $this->assertTrue($this->instance->hasAppPermission('email', 12312));

        $pass = false;
        try {
            $this->instance->hasAppPermission('not a field');
        } catch (Services_Facebook_Exception $e) {
            $pass = true;
        }
        $this->assertTrue($pass);
    }

    public function testGetPhoto()
    {
        $response = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<users_getInfo_response xmlns="http://api.facebook.com/1.0/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://api.facebook.com/1.0/ http://api.facebook.com/1.0/facebook.xsd" list="true">
  <user>
      <uid>683226814</uid>
      <pic_big>http://profile.ak.facebook.com/v225/131/23/n683226814_7025.jpg</pic_big>
      <pic_small>http://profile.ak.facebook.com/v225/131/23/t683226814_7025.jpg</pic_small>
      <pic_square>http://profile.ak.facebook.com/v225/131/23/q683226814_7025.jpg</pic_square>
  </user>
</users_getInfo_response>
XML;

        $this->mockSendRequest($response);
        $result = $this->instance->getPhoto(683226814, 'square');

        $pass = mb_strlen($result);
        $this->assertTrue(($pass === 1882));

        $pass = false;
        try {
            $this->instance->getPhoto(123, 'not a size');
        } catch (Services_Facebook_Exception $e) {
            $pass = true;
        }

        $this->assertTrue($pass);
    }
}

?>
