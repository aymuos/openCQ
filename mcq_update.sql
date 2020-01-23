-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2020 at 01:24 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mcq`
--

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `chapter_id` varchar(100) NOT NULL,
  `chapter` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chapters`
--

INSERT INTO `chapters` (`chapter_id`, `chapter`) VALUES
('android', 'Android'),
('c++', 'C++'),
('maths', 'Maths'),
('movies', 'Movies'),
('physics', 'Physics'),
('sqlanditsapplication', 'SQL And Its Application');

-- --------------------------------------------------------

--
-- Table structure for table `choices`
--

CREATE TABLE `choices` (
  `question_id` varchar(100) NOT NULL,
  `choice_id` varchar(100) NOT NULL,
  `choice` varchar(100) NOT NULL,
  `is_right` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `choices`
--

INSERT INTO `choices` (`question_id`, `choice_id`, `choice`, `is_right`) VALUES
('(x-a)*(x-b)*(x-c)...*(x-z)=?wherex>0andx>a,b,c,..,z', '0', '0', '1'),
('(x-a)*(x-b)*(x-c)...*(x-z)=?wherex>0andx>a,b,c,..,z', '<0', '<0', '0'),
('(x-a)*(x-b)*(x-c)...*(x-z)=?wherex>0andx>a,b,c,..,z', '>0', '>0', '0'),
('(x-a)*(x-b)*(x-c)...*(x-z)=?wherex>0andx>a,b,c,..,z', '>=0', '>=0', '0'),
('anacgeneratorworksduethechangein', 'magneticflux', 'magnetic flux', '1'),
('anacgeneratorworksduethechangein', 'magneticfluxdensity', 'magnetic flux density', '0'),
('anacgeneratorworksduethechangein', 'materialofcoil', 'material of coil', '0'),
('anacgeneratorworksduethechangein', 'timeofrotationofcoil', 'time of rotation of coil', '0'),
('androidisbasedonwhichkernel', 'linux', 'Linux', '1'),
('androidisbasedonwhichkernel', 'mac', 'Mac', '0'),
('androidisbasedonwhichkernel', 'redhat', 'Redhat', '0'),
('androidisbasedonwhichkernel', 'windows', 'Windows', '0'),
('androidwebbrowserisbasedon', 'chrome', 'Chrome', '0'),
('androidwebbrowserisbasedon', 'firefox', 'Firefox', '0'),
('androidwebbrowserisbasedon', 'open-sourcewebkit', 'Open-source Webkit', '1'),
('androidwebbrowserisbasedon', 'safari', 'Safari', '0'),
('canaclassbeimmutableinandroid?', 'can\'tmaketheclassasfinalclass', 'Can\'t make the class as final class', '0'),
('canaclassbeimmutableinandroid?', 'no,itcan\'t', 'No, it can\'t', '0'),
('canaclassbeimmutableinandroid?', 'noneoftheabove', 'None of the above', '0'),
('canaclassbeimmutableinandroid?', 'yes,classcanbeimmutable', 'Yes, Class can be immutable', '1'),
('deviationofelectronicspectrallinesinanexternalelectricfieldiscalled', 'armstrongeffect', 'Armstrong effect', '0'),
('deviationofelectronicspectrallinesinanexternalelectricfieldiscalled', 'bohreffect', 'Bohr effect', '0'),
('deviationofelectronicspectrallinesinanexternalelectricfieldiscalled', 'magleveffect', 'Maglev effect', '0'),
('deviationofelectronicspectrallinesinanexternalelectricfieldiscalled', 'starkeffect', 'Stark effect', '1'),
('duringalpharadiationsplitting,thenucleusissplitinto1positronand1neutronthusoutofthesetwowhichparticl', 'bothhavethesamespeed', 'Both have the same speed', '0'),
('duringalpharadiationsplitting,thenucleusissplitinto1positronand1neutronthusoutofthesetwowhichparticl', 'depends', 'Depends', '0'),
('duringalpharadiationsplitting,thenucleusissplitinto1positronand1neutronthusoutofthesetwowhichparticl', 'neutron', 'Neutron', '0'),
('duringalpharadiationsplitting,thenucleusissplitinto1positronand1neutronthusoutofthesetwowhichparticl', 'positron', 'Positron', '1'),
('howmanyorientationsdoesandroidsupport?', '10', '10', '0'),
('howmanyorientationsdoesandroidsupport?', '2', '2', '0'),
('howmanyorientationsdoesandroidsupport?', '4', '4', '1'),
('howmanyorientationsdoesandroidsupport?', 'noneoftheabove', 'None of the above', '0'),
('howtokillanactivityinandroid?', 'bothfinish()andfinishactivity(intrequestcode)', 'both finish() and finishActivity(int requestCode)', '1'),
('howtokillanactivityinandroid?', 'finish()', 'finish()', '0'),
('howtokillanactivityinandroid?', 'finishactivity(intrequestcode)', 'finishActivity(int requestCode)', '0'),
('howtokillanactivityinandroid?', 'noneoftheabove', 'none of the above', '0'),
('howtostoreheavystructureddatainandroid?', 'cursor', 'Cursor', '0'),
('howtostoreheavystructureddatainandroid?', 'noneoftheabove', 'None of the above', '0'),
('howtostoreheavystructureddatainandroid?', 'sharedpreferences', 'Shared Preferences', '0'),
('howtostoreheavystructureddatainandroid?', 'sqlitedatabase', 'SQlite database ', '1'),
('nameofthepresentgraphicsapiusedinandroid9andabove?', 'directx', 'DirectX', '0'),
('nameofthepresentgraphicsapiusedinandroid9andabove?', 'metal', 'Metal', '0'),
('nameofthepresentgraphicsapiusedinandroid9andabove?', 'openglapi', 'OpenGL API', '0'),
('nameofthepresentgraphicsapiusedinandroid9andabove?', 'vulkanapi', 'Vulkan API', '1'),
('neilbohr\'stheoryofthestructureofatomisonlyvalidif', 'atomhasasingleelectronsystem', 'atom has a single electron system', '1'),
('neilbohr\'stheoryofthestructureofatomisonlyvalidif', 'atomisareducer', 'atom is a reducer', '0'),
('neilbohr\'stheoryofthestructureofatomisonlyvalidif', 'hasamultielectronsystem', 'has a multi electron system', '0'),
('neilbohr\'stheoryofthestructureofatomisonlyvalidif', 'iftheatomhasnoneutron', 'if the atom has no neutron', '0'),
('opticalfiberisadevicebasedontheprincipleof', 'noneofthese', 'none of these', '0'),
('opticalfiberisadevicebasedontheprincipleof', 'scattering', 'scattering', '0'),
('opticalfiberisadevicebasedontheprincipleof', 'totalinternalreflection', 'total internal reflection', '1'),
('opticalfiberisadevicebasedontheprincipleof', 'totalinternalrefraction', 'total internal refraction', '0'),
('runtimepolymorphismisdoneusing', 'friendfunction', 'Friend function', '0'),
('runtimepolymorphismisdoneusing', 'functionoverloading', 'Function overloading', '0'),
('runtimepolymorphismisdoneusing', 'virtualclasses', 'Virtual classes', '0'),
('runtimepolymorphismisdoneusing', 'virtualfunctions', 'Virtual functions', '1'),
('sethasorder', 'depends', 'Depends', '0'),
('sethasorder', 'false', 'False', '1'),
('sethasorder', 'true', 'True', '0'),
('sethasorder', 'usercandefineorder', 'user can define order', '0'),
('thedefaultaccessspecifierfortheclassmembersis', 'noneoftheabove', 'None of the above', '0'),
('thedefaultaccessspecifierfortheclassmembersis', 'private', 'private', '1'),
('thedefaultaccessspecifierfortheclassmembersis', 'protected', 'protected', '0'),
('thedefaultaccessspecifierfortheclassmembersis', 'public', 'public', '0'),
('thegraphofphotoelectriceffectonametalisastraightlinehavingaconstantof', '-hfo(fo=thresholdfrequency)', '-hfo (fo= threshold frequency)', '1'),
('thegraphofphotoelectriceffectonametalisastraightlinehavingaconstantof', 'hf(f=frequencyoftheappliedradiation)', 'hf(f= frequency of the applied radiation)', '0'),
('thegraphofphotoelectriceffectonametalisastraightlinehavingaconstantof', 'kineticenergyofthereleasedelectrons', 'Kinetic energy of the released electrons', '0'),
('thegraphofphotoelectriceffectonametalisastraightlinehavingaconstantof', 'noneoftheabove', 'None of the above', '0'),
('thepointerwhichstoresalwaysthecurrentactiveobjectaddressis__', 'auto_ptr', 'auto_ptr', '0'),
('thepointerwhichstoresalwaysthecurrentactiveobjectaddressis__', 'noneoftheabove', 'none of the above', '0'),
('thepointerwhichstoresalwaysthecurrentactiveobjectaddressis__', 'p', 'p', '0'),
('thepointerwhichstoresalwaysthecurrentactiveobjectaddressis__', 'this', 'this', '1'),
('whatisbroadcastreceiverinandroid?', 'itwilldobackgroundfunctionalitiesasservices', 'It will do background functionalities as services', '0'),
('whatisbroadcastreceiverinandroid?', 'itwillpassthedatabetweenactivities', 'It will pass the data between activities', '0'),
('whatisbroadcastreceiverinandroid?', 'itwillreactonbroadcastannouncements', 'It will react on broadcast announcements', '1'),
('whatisbroadcastreceiverinandroid?', 'noneoftheabove', 'None of the above', '0'),
('whatisthefullformofstl?', 'noneoftheabove.', 'None of the above.', '0'),
('whatisthefullformofstl?', 'standardtemplatelibrary.', 'Standard template library.', '1'),
('whatisthefullformofstl?', 'standardtopicslibrary.', 'Standard topics library.', '0'),
('whatisthefullformofstl?', 'systemtemplatelibrary.', 'System template library.', '0'),
('whatistheoutputofthefollowingprogram?#include<iostream>usingnamespacestd;main(){chars[]=\"fine\";*s=\'n', 'compileerror', 'Compile error', '0'),
('whatistheoutputofthefollowingprogram?#include<iostream>usingnamespacestd;main(){chars[]=\"fine\";*s=\'n', 'fine', 'Fine', '0'),
('whatistheoutputofthefollowingprogram?#include<iostream>usingnamespacestd;main(){chars[]=\"fine\";*s=\'n', 'nine', 'Nine', '1'),
('whatistheoutputofthefollowingprogram?#include<iostream>usingnamespacestd;main(){chars[]=\"fine\";*s=\'n', 'runtimeerror', 'Runtime error', '0'),
('whatisthepackagenameofhttpclientinandroid?', 'com.android.json', 'com.android.JSON', '0'),
('whatisthepackagenameofhttpclientinandroid?', 'com.json', 'com.json', '0'),
('whatisthepackagenameofhttpclientinandroid?', 'org.apache.http.client', 'org.apache.http.client', '1'),
('whatisthepackagenameofhttpclientinandroid?', 'org.json', 'org.json', '0'),
('whatistheunitdigitof(1!+2!+3!+...+100!)?', '3', '3', '1'),
('whatistheunitdigitof(1!+2!+3!+...+100!)?', '5', '5', '0'),
('whatistheunitdigitof(1!+2!+3!+...+100!)?', '7', '7', '0'),
('whatistheunitdigitof(1!+2!+3!+...+100!)?', '9', '9', '0'),
('whatistransientdatainandroid?', 'logicaldata', 'Logical data', '1'),
('whatistransientdatainandroid?', 'permanentdata', 'Permanent data', '0'),
('whatistransientdatainandroid?', 'securedata', 'Secure data', '0'),
('whatistransientdatainandroid?', 'temporarydata', 'Temporary data', '0'),
('whichcoloroflightraysgetsscatteredthemost?', 'blue', 'blue', '1'),
('whichcoloroflightraysgetsscatteredthemost?', 'green', 'green', '0'),
('whichcoloroflightraysgetsscatteredthemost?', 'red', 'red', '0'),
('whichcoloroflightraysgetsscatteredthemost?', 'violet', 'violet', '0'),
('whichfeatureoftheoopsgivestheconceptofre-usability?', 'abstraction', 'Abstraction', '0'),
('whichfeatureoftheoopsgivestheconceptofre-usability?', 'encapsulation', 'Encapsulation', '0'),
('whichfeatureoftheoopsgivestheconceptofre-usability?', 'inheritance', 'Inheritance', '1'),
('whichfeatureoftheoopsgivestheconceptofre-usability?', 'noneoftheabove.', 'None of the above.', '0'),
('whichmethodisusedtofindgpsenabledordisabledpro-grammaticallyinandroid?', 'finish()', 'finish()', '0'),
('whichmethodisusedtofindgpsenabledordisabledpro-grammaticallyinandroid?', 'getgps().', 'getGPS().', '0'),
('whichmethodisusedtofindgpsenabledordisabledpro-grammaticallyinandroid?', 'getgpsstatus()', 'getGPSStatus()', '0'),
('whichmethodisusedtofindgpsenabledordisabledpro-grammaticallyinandroid?', 'onproviderdisable()', 'onProviderDisable()', '1'),
('whichofthefollowingsqlclausesisusedtodeletetuplesfromadatabasetable?', 'clear', 'CLEAR', '0'),
('whichofthefollowingsqlclausesisusedtodeletetuplesfromadatabasetable?', 'delete', 'DELETE', '1'),
('whichofthefollowingsqlclausesisusedtodeletetuplesfromadatabasetable?', 'drop', 'DROP', '0'),
('whichofthefollowingsqlclausesisusedtodeletetuplesfromadatabasetable?', 'remove', 'REMOVE', '0'),
('whichoperatorcannotbeoverloadedinc++?', '+', '+', '0'),
('whichoperatorcannotbeoverloadedinc++?', '=', '=', '0'),
('whichoperatorcannotbeoverloadedinc++?', '==', '==', '0'),
('whichoperatorcannotbeoverloadedinc++?', 'new', 'new', '1'),
('whohasthesuperpowerattheendofstrangerthingsseason3?', 'eleven', 'Eleven', '0'),
('whohasthesuperpowerattheendofstrangerthingsseason3?', 'lucas', 'Lucas', '0'),
('whohasthesuperpowerattheendofstrangerthingsseason3?', 'mike', 'Mike', '0'),
('whohasthesuperpowerattheendofstrangerthingsseason3?', 'none', 'None', '1'),
('whydoesthepulleysysteminmachineshelpsustoreduceoureffortofliftingobjects?', 'pulleysystemisdesignedontheprincipleofforcemultipier', 'pulley system is designed on the principle of force multipier', '0'),
('whydoesthepulleysysteminmachineshelpsustoreduceoureffortofliftingobjects?', 'pulleysystemmainlyreducestheweightoftheobjectbeinglifted', 'pulley system mainly reduces the weight of the object being lifted', '0'),
('whydoesthepulleysysteminmachineshelpsustoreduceoureffortofliftingobjects?', 'pulleysystemworksontheprincipleoffriction', 'pulley system works on the principle of friction', '0'),
('whydoesthepulleysysteminmachineshelpsustoreduceoureffortofliftingobjects?', 'weuseourownweightasaforcetopulltheobject', 'we use our own weight as a force to pull the object', '1'),
('workisformofenergywhichisdependenton', 'momentumofthebody', 'momentum of the body', '1'),
('workisformofenergywhichisdependenton', 'speedofthebody', 'speed of the body', '0'),
('workisformofenergywhichisdependenton', 'typeofbody(flexibleorrigid)', 'type of body ( flexible or rigid)', '0'),
('workisformofenergywhichisdependenton', 'workisanindependentformofenergy', 'work is an independent form of energy', '0');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `exam_id` varchar(100) NOT NULL,
  `is_active` enum('0','1','2') NOT NULL,
  `num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`exam_id`, `is_active`, `num`) VALUES
('sour', '0', 10),
('sweet', '1', 10);

-- --------------------------------------------------------

--
-- Table structure for table `exam_choices`
--

CREATE TABLE `exam_choices` (
  `user_id` varchar(15) NOT NULL,
  `exam_id` varchar(100) NOT NULL,
  `question` varchar(500) NOT NULL,
  `choice` varchar(100) NOT NULL,
  `is_marked` enum('0','1') NOT NULL DEFAULT '0',
  `is_right` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `exam_marks`
--

CREATE TABLE `exam_marks` (
  `user_id` varchar(15) NOT NULL,
  `exam_id` varchar(100) NOT NULL,
  `question` varchar(500) NOT NULL,
  `marks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `exam_questions`
--

CREATE TABLE `exam_questions` (
  `user_id` varchar(15) NOT NULL,
  `exam_id` varchar(100) NOT NULL,
  `question` varchar(500) NOT NULL,
  `question_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam_questions`
--

INSERT INTO `exam_questions` (`user_id`, `exam_id`, `question`, `question_id`) VALUES
('root', 'sweet', ' How to store heavy structured data in android?', 1),
('root', 'sweet', 'Can a class be immutable in android ?\r\n  ', 2),
('root', 'sweet', 'Deviation of electronic spectral lines in an external electric field is called', 3),
('root', 'sweet', 'During alpha radiation splitting , the nucleus is split into 1 positron and 1 neutron thus out of these two which particle has more velocity of emission than the other', 4),
('root', 'sweet', 'How to kill an activity in Android?', 5),
('root', 'sweet', 'Neil Bohr\'s theory of the structure of atom is only valid if', 6),
('root', 'sweet', 'Optical fiber is a device based on the principle of', 7),
('root', 'sweet', 'The graph of photoelectric effect on a metal is a straight line having a constant of', 8),
('root', 'sweet', 'What is transient data in android?', 9),
('root', 'sweet', 'Which color of light rays gets scattered the most ?', 10),
('toor', 'sweet', ' How to store heavy structured data in android?', 1),
('toor', 'sweet', 'An AC generator works due the change in ', 2),
('toor', 'sweet', 'Android Web Browser Is Based On ', 3),
('toor', 'sweet', 'Deviation of electronic spectral lines in an external electric field is called', 4),
('toor', 'sweet', 'Name of the present Graphics API used in Android 9 and above ?', 5),
('toor', 'sweet', 'Neil Bohr\'s theory of the structure of atom is only valid if', 6),
('toor', 'sweet', 'What is the package name of HTTP client in android?', 7),
('toor', 'sweet', 'What is transient data in android?', 8),
('toor', 'sweet', 'Which color of light rays gets scattered the most ?', 9),
('toor', 'sweet', 'Work is form of energy which is dependent on', 10);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` varchar(100) NOT NULL,
  `question` varchar(500) NOT NULL,
  `chapter_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `question`, `chapter_id`) VALUES
('(x-a)*(x-b)*(x-c)...*(x-z)=?wherex>0andx>a,b,c,..,z', '(x-a)*(x-b)*(x-c)...*(x-z)=? Where x>0 And x>a,b,c,..,z\r\n  ', 'maths'),
('anacgeneratorworksduethechangein', 'An AC generator works due the change in ', 'physics'),
('androidisbasedonwhichkernel', 'Android Is Based On Which Kernel', 'android'),
('androidwebbrowserisbasedon', 'Android Web Browser Is Based On ', 'android'),
('canaclassbeimmutableinandroid?', 'Can a class be immutable in android ?\r\n ', 'android'),
('deviationofelectronicspectrallinesinanexternalelectricfieldiscalled', 'Deviation of electronic spectral lines in an external electric field is called', 'physics'),
('duringalpharadiationsplitting,thenucleusissplitinto1positronand1neutronthusoutofthesetwowhichparticl', 'During alpha radiation splitting , the nucleus is split into 1 positron and 1 neutron thus out of these two which particle has more velocity of emission than the other', 'physics'),
('howmanyorientationsdoesandroidsupport?', ' How many orientations does android support?', 'android'),
('howtokillanactivityinandroid?', 'How to kill an activity in Android?', 'android'),
('howtostoreheavystructureddatainandroid?', ' How to store heavy structured data in android?', 'android'),
('nameofthepresentgraphicsapiusedinandroid9andabove?', 'Name of the present Graphics API used in Android 9 and above ?', 'android'),
('neilbohr\'stheoryofthestructureofatomisonlyvalidif', 'Neil Bohr\'s theory of the structure of atom is only valid if', 'physics'),
('opticalfiberisadevicebasedontheprincipleof', 'Optical fiber is a device based on the principle of', 'physics'),
('runtimepolymorphismisdoneusing', ' Runtime polymorphism is done using ', 'c++'),
('sethasorder', 'SET has order ', 'sqlanditsapplication'),
('thedefaultaccessspecifierfortheclassmembersis', 'The default access specifier for the class members is', 'c++'),
('thegraphofphotoelectriceffectonametalisastraightlinehavingaconstantof', 'The graph of photoelectric effect on a metal is a straight line having a constant of', 'physics'),
('thepointerwhichstoresalwaysthecurrentactiveobjectaddressis__', 'The pointer which stores always the current active object address is __', 'c++'),
('whatisbroadcastreceiverinandroid?', 'What is broadcast receiver in android?', 'android'),
('whatisthefullformofstl?', 'What is the full form of STL ?\r\n ', 'c++'),
('whatistheoutputofthefollowingprogram?#include<iostream>usingnamespacestd;main(){chars[]=\"fine\";*s=\'n', 'What is the output of the following program?\r\n\r\n#include<iostream>\r\n\r\nusing namespace std;\r\nmain() {\r\n   char s[] = \"Fine\";\r\n  *s = \'N\';\r\n   \r\n   cout<<s<<endl;\r\n}', 'c++'),
('whatisthepackagenameofhttpclientinandroid?', 'What is the package name of HTTP client in android?', 'android'),
('whatistheunitdigitof(1!+2!+3!+...+100!)?', 'What is the unit digit of ( 1! + 2! + 3 ! + . . . + 100! ) ?', 'maths'),
('whatistransientdatainandroid?', 'What is transient data in android?', 'android'),
('whichcoloroflightraysgetsscatteredthemost?', 'Which color of light rays gets scattered the most ?', 'physics'),
('whichfeatureoftheoopsgivestheconceptofre-usability?', 'Which feature of the OOPS gives the concept of re-usability?', 'c++'),
('whichmethodisusedtofindgpsenabledordisabledpro-grammaticallyinandroid?', ' Which method is used to find GPS enabled or disabled pro-grammatically in android?', 'android'),
('whichofthefollowingsqlclausesisusedtodeletetuplesfromadatabasetable?', 'Which of the following SQL clauses is used to DELETE tuples from a database table?', 'sqlanditsapplication'),
('whichoperatorcannotbeoverloadedinc++?', 'Which operator can not be overloaded in C++ ?', 'c++'),
('whohasthesuperpowerattheendofstrangerthingsseason3?', 'Who has the superpower at the end of Stranger Things Season 3 ?', 'movies'),
('whydoesthepulleysysteminmachineshelpsustoreduceoureffortofliftingobjects?', 'Why does the pulley system in machines helps us to reduce our effort of lifting objects ?', 'physics'),
('workisformofenergywhichisdependenton', 'Work is form of energy which is dependent on', 'physics');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `user_id` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `year` set('1','2','3','4') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`user_id`, `password`, `name`, `department`, `year`) VALUES
('root', '123456789', 'root', 'root', '3'),
('toor', 'root', 'Saranya', 'CSE', '3');

-- --------------------------------------------------------

--
-- Table structure for table `syllabus`
--

CREATE TABLE `syllabus` (
  `exam_id` varchar(100) NOT NULL,
  `chapter` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `syllabus`
--

INSERT INTO `syllabus` (`exam_id`, `chapter`) VALUES
('sour', 'Android'),
('sour', 'C++'),
('sweet', 'Android'),
('sweet', 'Physics');

-- --------------------------------------------------------

--
-- Table structure for table `temp`
--

CREATE TABLE `temp` (
  `id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`chapter_id`);

--
-- Indexes for table `choices`
--
ALTER TABLE `choices`
  ADD PRIMARY KEY (`question_id`,`choice_id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `exam_choices`
--
ALTER TABLE `exam_choices`
  ADD PRIMARY KEY (`user_id`,`exam_id`,`question`,`choice`),
  ADD KEY `exam_id` (`exam_id`);

--
-- Indexes for table `exam_marks`
--
ALTER TABLE `exam_marks`
  ADD PRIMARY KEY (`user_id`,`exam_id`,`question`),
  ADD KEY `exam_id` (`exam_id`);

--
-- Indexes for table `exam_questions`
--
ALTER TABLE `exam_questions`
  ADD PRIMARY KEY (`user_id`,`exam_id`,`question`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `chapter_id` (`chapter_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `syllabus`
--
ALTER TABLE `syllabus`
  ADD PRIMARY KEY (`exam_id`,`chapter`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `choices`
--
ALTER TABLE `choices`
  ADD CONSTRAINT `choices_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_choices`
--
ALTER TABLE `exam_choices`
  ADD CONSTRAINT `exam_choices_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `student` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_choices_ibfk_2` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`exam_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_marks`
--
ALTER TABLE `exam_marks`
  ADD CONSTRAINT `exam_marks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `student` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_marks_ibfk_2` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`exam_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`chapter_id`) REFERENCES `chapters` (`chapter_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `syllabus`
--
ALTER TABLE `syllabus`
  ADD CONSTRAINT `syllabus_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`exam_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
