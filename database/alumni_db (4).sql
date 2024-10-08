-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2024 at 02:29 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alumni_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `alumnus_bio`
--

CREATE TABLE `alumnus_bio` (
  `id` int(11) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `batch` year(4) NOT NULL,
  `course_id` int(11) NOT NULL,
  `status` int(64) NOT NULL,
  `img` longblob NOT NULL,
  `connected_to` text DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `studentId` varchar(255) NOT NULL,
  `homeAddress` varchar(255) NOT NULL,
  `mobileNumber` varchar(20) NOT NULL,
  `currentlyEmployed` int(65) NOT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `contact_method` enum('Email','Phone','Mail') DEFAULT NULL,
  `interests` text DEFAULT NULL,
  `kinderSchool` varchar(255) NOT NULL,
  `kinderYear` year(4) NOT NULL,
  `gradeSchool` varchar(255) NOT NULL,
  `gradeSchoolYear` year(4) NOT NULL,
  `juniorHighSchool` varchar(255) NOT NULL,
  `juniorHighSchoolYear` year(4) NOT NULL,
  `college` varchar(255) NOT NULL,
  `collegeYear` year(4) NOT NULL,
  `postGrad` varchar(255) DEFAULT NULL,
  `postGradYear` year(4) DEFAULT NULL,
  `programs` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`programs`)),
  `consent` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alumnus_bio`
--

INSERT INTO `alumnus_bio` (`id`, `lastname`, `firstname`, `middlename`, `gender`, `batch`, `course_id`, `status`, `img`, `connected_to`, `email`, `password`, `studentId`, `homeAddress`, `mobileNumber`, `currentlyEmployed`, `occupation`, `company`, `linkedin`, `contact_method`, `interests`, `kinderSchool`, `kinderYear`, `gradeSchool`, `gradeSchoolYear`, `juniorHighSchool`, `juniorHighSchoolYear`, `college`, `collegeYear`, `postGrad`, `postGradYear`, `programs`, `consent`, `created_at`, `updated_at`) VALUES
(3, 'Cepeda', 'Julius', 'Unciano', 'Male', '2024', 3, 1, 0x696d67, NULL, 'julius123@gmail.com', '', '2018-01318', '02123', '123123', 1, '123', '123', NULL, 'Email', NULL, '123123', '2020', '123', '2020', '123', '2024', '123', '2024', '123', '2024', '[\"CASE - Bachelor in Secondary Education major in Integrated Social Studies\",\"CASE - Bachelor in Inclusive and Special Needs Education\",\"CASE - AB Religious Education\",\"CASE - BS Biology\"]', 0, '2024-10-07 10:29:30', '2024-10-07 10:29:30');

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(30) NOT NULL,
  `title` varchar(250) NOT NULL,
  `img` longblob NOT NULL,
  `content` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `title`, `img`, `content`, `date_created`) VALUES
(4, 'Middle Powers Hold Roundtable Discussion at SPUQC', '', '<b>Good Morning everyone! today<p style=\"margin-bottom: 0px; padding: 0px 0px 1em; border: 0px; outline: 0px; font-size: 15px; text-size-adjust: 100%; vertical-align: baseline; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; color: rgb(102, 102, 102); font-family: Roboto, Helvetica, Arial, Lucida, sans-serif;\">The Ambassadors and Diplomatic officials of Mexico, Indonesia, Turkiye, and Australia held a roundtable discussion on the role of middle powers in the ever-evolving geopolitical landscape of the world at SPUQC.&nbsp; The diplomatic event was held last 20 November 2023 at the Sampaguita Hall of St. Paul University Quezon City dubbed Philippines+MIKTA (Mexico, Indonesia, South Korea, Turkiye, Australia) Roundtable Discussion.</p><p style=\"margin-bottom: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 15px; text-size-adjust: 100%; vertical-align: baseline; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; color: rgb(102, 102, 102); font-family: Roboto, Helvetica, Arial, Lucida, sans-serif;\">Sr. Ma. Nilda Masirag, SPC, University President, in his welcome adddress, greeted the esteemed guests, participants, and diplomatic officials and underscored the importance of the event, saying: “This forum offers a unique opportunity for us to engage in thoughtful dialogue, share insights, and chart a course for a future that is increasingly shaped by the actions and collaborations of middle powers.”<br><br></p><p style=\"margin-bottom: 0px; padding: 0px 0px 1em; border: 0px; outline: 0px; font-size: 15px; text-size-adjust: 100%; vertical-align: baseline; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; color: rgb(102, 102, 102); font-family: Roboto, Helvetica, Arial, Lucida, sans-serif;\">Mr. Agus Widjojo, Ambassador of the Republic of Indonesia spoke of MIKTA’s role and achievements as well as thrust and future directions of the association.&nbsp; He also expressed his gratitude to SPUQC for co-organizing the event with Indonesia, the current country President of MIKTA.&nbsp; Mr. Daniel Hernandez Joseph, Ambassador of the United Mexican States shared points of engagement where MIKTA and other countries can launch peaceful cooperation and support.&nbsp; Mr. James Yeomans, First Secretary and Deputy Chief of Mission of the Embassy of the Republic of Turkiye and Mr. James Yeomans, Minister-Counselor of the Embassy of the Commonwealth of Australia also shared their country’s efforts in promoting the values and objectives of MIKTA.</p><p style=\"margin-bottom: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 15px; text-size-adjust: 100%; vertical-align: baseline; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; color: rgb(102, 102, 102); font-family: Roboto, Helvetica, Arial, Lucida, sans-serif;\">Dr. Marlon Patrick P. Lofredo, CSIR Director, on the other hand, spoke of areas of cooperation and collaboration between the Philippines, SPUC, and the MIKTA countries for the promotion of the associations’ ideals and visions as well as sharing of expertise and resources in the areas of research, social development, and educational development.&nbsp; He said: “MIKTA and the Philippines faces both challenges and opportunities as it navigates the currents of a changing geopolitical landscape. By recognizing the shifts in global dynamics and embracing collaborative strategies, MIKTA and the Philippines can position itself as a dynamic and influential force in shaping a more stable and prosperous world.”</p>', '2024-08-02 20:06:01'),
(12, 'HOUSE TARGARYEN', 0x89504e470d0a1a0a0000000d494844520000016c0000002008060000003672421a000000097048597300000b1300000b1301009a9c18000000017352474200aece1ce90000000467414d410000b18f0bfc610500001578494441547801ed5d5f6edb48d2af262565df467b82684e30f609c63ec128183bfbbdc54eb20b7c4f495e168883c13818d801f625ced3029b3ff6bc2d920c629f20ce09e239419813acf66d2389ecad5fab9b6eb6488a1449d333eb1f605894c826d95d555d555d554d74852b5ce10a57f84d401c3ef9bf4128a7bb82c4ad94df4792a2edbb3bbf1c5309a0cd4886eff9e360ee86446761281ffcf987b7a70bdbd91df6a36e77c81fbfe5eb56a450edf5e3b6249d492102feedf8cb78fce1ff778f032a80977b9b5bfc204fedb60c22291f7726d383eddde31195445ebb5246cffc49b86bdac5bb85d7bab7bc8886fabd06d6e901bf5b1051f4eb64121e98f77af1d3f743e989155a129e27aedf79f8663bef9c97fb1b3f4612c3543f04c93e45747af7877c7a7ab1fffdd01f87a7cb8c818b57fb376f71e76f395ff7b9cf314603ebbb11fa5c7a7426a43815e3f149d5fb638ca77e6745787228847f9da90063d7a773fa50f7c47fa6e39194e1671ea44f348d3ef3108c3ae1f46c996700ff4da7d341111e5b84e73f6dacf99ef8d1fd3e85664bf1239e91dff79d64be4ef9398842b99df7fc65aeafca37a0dbbb8f7eb93f7fffe8dbdb3baf7fa69aa0e507fa7ae0fe66e447cc982ff6be3f10c2bb679f341e4fbe2e2a045d2861dbeb7e746e1edcd979f3f5a26b4124c2a72d9e44bea3a4f01be93fee2c792a84584b5c28e868fc65f2b8c8333fdfdfb8ef91786a7f17114f243b6f0fa802f0ec9e2fde27dae549e0cf8fdeee9ae3c3277fba17c908c778b780249df2bd3fab5710f40dbff7d0ba3cd167203ee17b78ee019584fb1ca9cf9fd22f7522ecd0ea5ffefae62cef9c577b9bef43214faa8e85c1f3bd8d5d4f384287698599fd4c44f46f16d25f3147ac3a4a4bc0fd70b4bdf3fa319584a25f25a43db467e8371e676e3730e7f2f1408f3904cac06d0b42f0cb6472a30c1fbed8df38e27b7f75e7e1eb1b5403d2681a8a57c47d88fec3312b762b7c4ff0ebc03a29971fb58cf844491e0f58eeac177d5fd00a4f1e6bf67769722b4f182e421adf68a5f4134f0ceb754c8c06ffd8db5cf1057dccba7f2cb075e7fdcb1c73279cdc7df8664815e032bf107278fbe1db93acf395d6d9eb1cd88c03c14c9e38a628fa5a90c733b85ce3dfbf85107bb9bff9494a3a60aa4e301bdf737711a3b9efcb18719b7fa41ac0cf85766322e476cffb79ffe68fcca4bbea40d2f69d476f8edceb6d0b05ef7ff7d1db75fb77978124c99f654873ed00a223be61a687763028425c16c18c98509e89489e41db9b6b7736a19e8f93a0fb722a7f9d3b0f5ab52f86fadc857d6c18819ff9f4f6a337eb5413f2c6c4beb7abb541608ac964bd88a60b9aa25e0fe36bb431d587b02a8a30759650497bd6dc76982fd086379efcb10e2b05e049e09dad4864d152cae4982b805d45b1acd2a4159877e6388d5fe267ab916f0c9df2c7512869fd2f8ff29590327027217b1c3be64b7cc1037dfec011fd8b2ac293cce816a985d3d96c9c06080a9eb1992862621d3181dc6781a64c0e10421ad54e269313268667dc81bb46c84120bedcbfb9e28dc7db5904ebbe2fcd34f7ba80b6e6dc2230f58db05684f9e8ed51dac5db0fff19f0fbacf3fb7c64e1f1c1fdbdd3e904fc5b7ccc93569023104eb9ad1310174c6c5a00101ef7cb8889f4469e90e1f15813d6804058e79c7fcc8cc97d22bea105d0ee394c006b60b0bab49799b91e334190768eeaf7dde13af5baef8dd0e66b56a8db8540c89d3cce27593950d7b1e0984ca6db6534634cde7cff635b6981264b25803e23cd43d36e070267976a00d3d8af3cdeb1c09e86d320ed3c68824c1b6409ed418ffb93df6b358d1761e647bd734bc497caaa2e6e59f9096b94d0e759a796e51b96491fa0bc2ce09b3e9ff39ecfad4d6847427e1696e0b4fbcda34b00add5d93e6fcccaab65fc43603668dd301f66dfc8a1ec2a42e9d3258127cf3589ce787a94772ede07da99ef25cda36580b6a00117d5b6d85ff6739d661e00c64c9b7c5cc07a329fbd4eeaba4aa3401fb1bf19ae84b8afcce491758dbb66031a8496b78c3b11f7bfbbf3760b16866eab942201cbc77c66a1798f5a0084b6797e8d819e3ce680f765e525b686d1d76adda100d0efb695877e5fd6859b060860b459806f94d0fefbee70400da375818d4ed7c23af6f595f161b900b118a10dede8b2086d3c836de614119e1daf7334f5c567aa01fe9749e1c90fc2956a06de178bb979e7d8daa182a4611b6367264bfb3bf8a4d3ce4d13d68bd6098a80dd307ad298773365c115608c7ede44d324c248265c92be509a732ae002b1053cbb2a0e8a8cbbee778360117d2d83126df66149342db45b17d8bad3e3c1a922ac0dec191e423bea761b5b442b8c6b7f481060918185e058b4405714657c9975f93dcbb66b6b871afd2ccdac7144090d11213683b4d3e0c2212dace106a94358034af3e44903511745af89a2704d7f8cfb392dc2e322a02db4732b253d9a2386f07cdb95d1a76bbddce756fe7e6b721758b76a806e4bb639685a68b72ab0dd4eafd3a4d10430eb6c415b589ca04b844eb7b345bf61d8910e75c0d60eb11814dfa72db3de11389ea4ebee39ae469be73f5d06d0eea414a745cf67afe7ec5984ba463d3bacbab62c4c1ec753fb384f9069ab26d6caf9f37db84ad3ce45bfebc5d919041dd5195eb72402fdbf51a1ddae866d773abff07492efd72d03d7ace595e4c3365d23781eb205002fca6411e4ff222ced30800f97ce19a035b39eacf14af3256bed7a06161a75fa4f0168774517b254848b76b945d3e819d621cc6fad5929940c32f8c382857ded7e08e263a274cb584698c407fa2840e820b50d498f2d45a331a1dd9ac09ef3570a3aad9be0e103b60efb2d12ae82eb1765dffdbbcbb428da268490334d5ac48b6db1c069cbacb721bca44531b7e03595ad6a78d6e4a1221f64248ecd6fb0522e019d058bdc0bca0d14cad84ac104e45ac66acde03c6c52b942ea961bcbc25e2c660cae75bbb5f3776b02db5dc46982e0a1d5da8b19790b1f1701578320c4595fb2489636a0b4c359e2484c07f664dba6596f201cd784651100a3baa36acac244d7b030534a81e3d2e9cb5eaf55da3713f122a8c9c672892149cc1efb4846b1d6cd6b066797c0159200168b4d286613410fad096c8fbc444c6e9118e16580f46ef3190b1ffff85b7b6e08578300cca05e4448d06585ab1de2833bd9b6641d0df4ffc0150c52c858004270508bd05ae8009fa7e369ac59272cbaf9f4fcc6e14911fbfdcb2864fe788ab136934d1c12385bf33a57f478cda0964cce3aa1c242c793f5a6847627f3174ff4ab0a11a4fc32d3a5ff2612abc641539109c88e4c1c4fe51a954c46a81310484c78dbfc6087e63bf485f679ad5f16f3ee22116b8732c9d4484fe7c5cd357cd666fd415374e2c2f69bbbcfa59e07d6517c543cf4ae11e8e41144a924e807912efe6c9da8ee44a4455099c4daa7aea2674adc1763fc7c7fe3b1c992c6d8336f1cd96b5e75c75cd7093cbf9d80a58536dea5f2a274b6c09672c842a45a644586b056836985f2f18006d4104216cebe75ccb3fec26cbba6818cb6e77b1b032785572d54f042e48db2195348ffce9b5c7bddee1a2208ea4cf5ae0b09edd05974467251d48b4332fbf25a0782fd842aa208bdf9be78aac937480bd5332e1cfdf942269134e83870e54bf7847764ff0621f96a6ff3d42c466a37e429d580450b88d4ebdd33026099e819c466f3b37fa79f1d31ce48208b73356a89756f906f8cd096a69e92a02d56d4c0fb9584763b2e112726b949743d3f4158acf5d7522fa42a14c1c9b9191749441f5feedf2c65fea3160313f4a7ac3f68f3babadae583af43f95ced90b4796967cc45e242dc2287fb379feab8e111f202165e20a835816dfbd25161d0fd3d24196797a218555da6799ea5834c45bb04c3b29af094e8817578eec776dc8acba208df90a0a5fb0b7de4091ff413cc6ea884f6215540a6868de24f932f934a0cd2e975864d567e2b842fff19f154797e1cc9afe8924069da3f6d049e2f50abc2220cf99485c657452bc5c15f26e5bc9b47aa4a703397429356ccb2d0daa1b2e25cedd0800527dc116bea734d663df7c940e70024ef3573e1dd8f4c3d108ab62fcaec8620fd0fe50b0768b5aea044748daa862be8284d8862a19bad1463c9f5ebaa2f92d57faa5c3029b7a3c9fa3ca025014b932dd1c7094b94dfb3b6fa3205f8a66c690017565da059362c0b6de6ed60992a9040a6c046f1a7aac4ca839a28fe74857980f8784057ddfae1d0507860a9c8c086529e64998871053a4ffc9b2e199476a8e9234d3b04bcc9e458bb459430abc9ac1fd86b0806f67acbac6a5c6eddee80cc78c9e5b53003558c6c6f73985102349061f480c2f0d4fe1271fc2683306b510fedda6e111d29b54b5591d17f528f270bd9833b3b6f76a92a2c3fbc3efe40356111df8027450d0962aed02ec3db2e3a7409c083db9c8b04ee17ab429703cc9e4dbb6716ced073b3b006069635ca0f55340addf60d29a7d5d6231a40ac1da20c292fcac0c7e7229afd8bc7499bf555d3904788ec80a64d94ee2a62cb100b5dc74594163ef73ad50053adcfa9113dca2ad7e009c423cf24a4e7895bdc7fe945932cb31e02be0e2b45953de67605a56f0cc09ae9164f283fd75976f4226178722aa75b5403ea12daadf8b075d65f0cd9a0d09c4461b2eda4a67911bec742f7409f24fc5d1aec2ea99ca189b6ed70afcb80997618337b1fa662e65f52a8564e8082b046353d547744ad61d65e6fb019ecf64f6ee2039f7f2e88acb2a355a1fdf6b6901b654d1a7665c3bcfe73eb78d4918884febbbbf37615b5ba512fda8e9dd6b8b00a764d41f14dcdd9d7368f6ba15d6a2cda4c4d0faccf83a61223bc281ad8c74a33309f29113f3ba0fab054040c0634949428ed498843ed55af3bd2b42f36ab3e721666dae10c109860fabc3ffbda3a13a05439d31f7e3966e1738399e96bb2e852859e661421724ac55e78fabc1d5d035f7181fe8b69aaee442468ebc8f243ff3982bbdf44b6df45a2f672031585766b2e1129a3137ba709ec7d4735851c25eee38915db8d2e3b56c69a949fc9aac20f6da0ea00b9218b656374d506027b9b0f6c1fa15e0039a0df118c7688859f3b3f2cde33d4f6c3d665d6bbd01b18ac46bddea149d0401122bed7c9dcbd42d682ad78515dbbfb942e0afe795a3cb4c04574cb8b77cfecc5bb3a373730d096f316df2b30f7c2a4276693de03ba8202fa09e1bba6ac3484f62b5e882c92b5d99a866dd73a00b2ea0d57856f9b8d3cabd9e54adda41ac45d5245e8892706fb16df5349c0976987b3f1e7d663c7eb845da531a4621970511425ebb034545f4485628dc7dbc24aae42148fab25bad5fc7816d9baa8625eba8e497ab24c06dcbace4dd617c1421e368d35c77ad25ba32bc4806286adc5c8545524795464e386d604b626f8c01cd719236a60573053f720b16bff8e08044ad4ec8d2a331c0be8817538cadbc3320f3a9ced77093badbba86fdd9f45483466d6db80d00e439988019e69dd49b8c5bcd85cad14635b1476ec755638a48bb998f686eb8be84d3002735cc75accef0d69427bd1c4d66a795515aa748edaabe945726ad7529e333940c476194abdcb7525d8c28867885818952556cff34fe3362f610cf5b2b0b54368b1455d50ee58014dd617514588a4add5cba19bd0a4b5567b1259397c72b3f9bc032b45fbcb785c38cccddd05a6c9fa22297573066993deff3ad43664a18c6ba2c09af372f63e6d556063b1c79ef575cd8001d50055e49cc49639ceca58f3bdae6d2a565a3c825016baf685baa755a7d775959443cbb52a6a84ad1d16758718b86eb4a6cb86ba5a22129a6cb787bb1f2100f3bfecca7f19e8fb0fd4d314748718cced02b360afcaaa2832e95d418fcb79d6735fe6ecced3fa16617aefba401ff6f50ecb959910c922a417fff2d263dd9d2eaaf846a3aeaabd32bba75b9cc62bc71cb6609b4cc2da161c5b374b2dedb06ca82108db35ebeb88a0c982955a1c0b39d430b7950ad4bc480a25bdf2df90a66d47d7147587d870dd384d6f748c494f248aadc9a7976df7a722689a6fb06e9552aa620ead0becb97c7b5d23ba8aa6fdf2c9e6619c0186f4d89dfcf458670fc8b56534a4c4b645421cbb195442d0a0e86460b755675532b43be97607d412ec4d2bcab8436ca0829f7deccb666b9cabc80799887098db4de4eea35feebb71c8d0b45fee6f7eaa3b0ed98ebd2ee30e319094b4529adee8d8da853e30df61f7a7dfd26e4be09b6a1672311411daad0b6cc0c4261aa237e5468b6e776f808e7db5b7f91e2bf604ad885fbe68552fbbf078d9d8487be76cb4e17d19a776ba9a0c16685e2064d316faa3c8f3fb24be5bc4746ad776b63a44245bd3b0939bec8aa5ac0654f0a30b34eb0130926d85519ad0de79bbe59c63cefb0405a20ec16d47d794758718c0673a67a5345c6b3c25bf4025d5b4ad6917e51b6777f64691426b09c4027be6f3ad1791480a07bf4399859730a86a2fbfd90c13d04c601d41004370a31462d6b560d8177bdf1f70c77e04038398d967bdaa66ac828026707be7cdaae92c086d305a9e30c06082896201cba631dac84b9b369a17dec93031da51efb0bf71846a7da62dbdb7e11cdcec4db5337caffb314b28a868195d9bb76c824be67b3863dbf13b83bcf3f5626325ed10508b8fcee6ae452c17bb5aa14e492f054c9c6942db562ad439b32495207973da52827bffe63b9c9fa55d820640efc9c8a6f3c949984d7669397788816ba514590b104eb5c7b25ab91b11c1e8b3a6fdaeac35ebd25d192ccb37fc71e06eb0329d4e13d7d411616690426b31e2ac11749c2989a8811a06abcb9ae36a6632b560cdcd249ddd7ef466b5c8f54a9b700ae1a8ea5a331f711f11033aaa634496d621237a5c35a102031546d34353b18b14038ab348ce76afc1e4c166de759a5525c3f3045811cfbbafad85530e8abc0304bbbd9fa00d684f9147c7722a7fc573fabeff8dde034f112b5289a922d2de05f7cdab1bfcf2c9cd77a8b16e8e9112be4c3d10d055d8eb1cb8efcf2bebbb5975190e9ffce91e8f5d42a387605d864e9eef6fdce77b812e6de60f98f90fd0e7d213239dfcb4c513cb2d8b865c8c2899d1da77da54513158bf000fbafc29841c2e1b320acd16c2d2fe0ebcc956e67ada98a48d378a3b6d3f7c5d3a1926830f0224d29945657b5cdc090ce732edac2e433b797cc33d702c05f35e41be71e919cf9555f365593cdfdbd84502927d6fa166ca5eef477b634bfb2110bb5c76df34680aba007cdaac53eac59486cb0b76fcc4dfa6149b0910f2a6d284233aad2aa85d28c14de177ac160f9d4241336683708cd86d51e2be1623e33d400cd018d94f2a3f806073857efe58154180fa195401180fc4d452eac4238ec7e371bcc08be785ef2f8316164e722ea0999aecb0d413041d85113d330587747fdd731411fb820777765e9776cd28ba90535e4c53fef3780ca5a41384fad9c2449d3b9dac808609e15a331a1e90239c751b67c8be051d40a3533baf707fc395942268146fa2ca6151e115576ecc8e4298e3f7dcf1e6fe4624545921a57cc2d1748b85d12dddeeecfd596847e41d61fcd4b346e1a123ace3e72c433b4a79bcd63b74046c61405184e56c9ebdaee72a02086ddb2dfa5f2c2de0bd6affccd50000000049454e44ae426082, '123123', '2024-10-07 16:50:18');

-- --------------------------------------------------------

--
-- Table structure for table `career`
--

CREATE TABLE `career` (
  `id` int(30) NOT NULL,
  `company` varchar(250) NOT NULL,
  `location` text NOT NULL,
  `job_title` text NOT NULL,
  `description` text NOT NULL,
  `user_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `career`
--

INSERT INTO `career` (`id`, `company`, `location`, `job_title`, `description`, `user_id`, `date_created`) VALUES
(1, '123123', '123123', '123123', '123123123', 1, '2024-08-01 10:05:27'),
(2, '123', '123', '132', '123', 1, '2024-08-02 19:49:54'),
(3, 'Accenture', 'BGC TAGUIG', 'Software Dev', 'LIKA NA TOL, THIS IS GOOD SHIT', 1, '2024-09-25 08:34:18');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(30) NOT NULL,
  `course` text NOT NULL,
  `about` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course`, `about`) VALUES
(1, 'BS Information Technology', 'Sample'),
(3, 'BS Computer Sciences', ''),
(4, 'BS MedTech', ''),
(5, 'BSss', '');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(30) NOT NULL,
  `title` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `schedule` datetime NOT NULL,
  `banner` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `content`, `schedule`, `banner`, `date_created`) VALUES
(1, 'Sample Event', '&lt;p style=&quot;margin-bottom: 15px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; padding: 0px; text-align: justify;&quot;&gt;Cras a est hendrerit, egestas urna quis, ullamcorper elit. Nullam a felis eget dolor vulputate vehicula. In hac habitasse platea dictumst. Nunc est urna, gravida sit amet ligula ut, aliquam fermentum lorem. Vestibulum non suscipit velit, in rhoncus orci. Vivamus pulvinar quam nec leo semper facilisis quis eu magna. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum lectus lorem, iaculis sed nunc nec, lacinia auctor risus.&lt;/p&gt;&lt;p style=&quot;margin-bottom: 15px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; padding: 0px; text-align: justify;&quot;&gt;Aenean elementum, risus eget rutrum dapibus, tellus leo eleifend leo, et mattis turpis quam eu turpis. Suspendisse commodo placerat tellus, quis faucibus metus euismod sed. Cras vitae risus in felis dignissim fermentum. Morbi aliquam nisi ipsum, id aliquam tortor congue eu. Sed fringilla convallis augue, et vulputate ante convallis vitae. Integer lacinia lacus at vehicula finibus. Nullam ultrices turpis dui, volutpat pulvinar augue placerat in. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis quam metus, sollicitudin a lectus non, tincidunt sagittis odio.&lt;/p&gt;', '2020-10-16 10:00:00', '1602813060_no-image-available.png', '2020-10-16 09:51:55'),
(2, 'SPUP Quezon TCON', 'There will be a TCON in SPUP QUEZON!', '2024-10-31 17:00:00', '', '2024-07-01 14:08:25'),
(3, 'Lodicakes', '1213123', '2024-10-10 22:00:00', '1728304620_St._Paul_University_QC_seal1.png', '2024-10-07 20:37:44');

-- --------------------------------------------------------

--
-- Table structure for table `event_commits`
--

CREATE TABLE `event_commits` (
  `id` int(30) NOT NULL,
  `event_id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_commits`
--

INSERT INTO `event_commits` (`id`, `event_id`, `user_id`) VALUES
(1, 1, 3),
(2, 2, 1),
(3, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `forum_comments`
--

CREATE TABLE `forum_comments` (
  `id` int(30) NOT NULL,
  `topic_id` int(30) NOT NULL,
  `comment` text NOT NULL,
  `user_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forum_comments`
--

INSERT INTO `forum_comments` (`id`, `topic_id`, `comment`, `user_id`, `date_created`) VALUES
(1, 3, 'Sample updated Comment', 3, '2020-10-15 15:46:03'),
(3, 3, 'Sample', 1, '2020-10-16 08:48:02'),
(5, 0, '', 1, '2020-10-16 09:49:34'),
(6, 1, 'okininam', 21, '2024-07-22 09:57:09');

-- --------------------------------------------------------

--
-- Table structure for table `forum_topics`
--

CREATE TABLE `forum_topics` (
  `id` int(30) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forum_topics`
--

INSERT INTO `forum_topics` (`id`, `title`, `description`, `user_id`, `date_created`) VALUES
(2, 'Sample Topic 2', '&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; text-align: justify;&quot;&gt;&quot;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;&lt;/span&gt;', 3, '2020-10-15 15:20:51'),
(3, 'Sample Topic 3', '&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; text-align: justify;&quot;&gt;Vivamus gravida nunc orci. Proin ut tristique odio. Nulla suscipit ipsum arcu, a luctus lorem vulputate et. Maecenas magna lorem, tempor id ultrices id, vehicula eu diam. Aliquam erat volutpat. Praesent in sem tincidunt, mattis odio nec, ultrices justo. Vivamus sit amet sapien ornare tortor porttitor congue vel et lorem. In interdum eget metus ut sagittis. In accumsan nec purus vel ornare. Quisque non scelerisque libero, et aliquam risus. Mauris tincidunt ullamcorper efficitur. Nullam venenatis in massa et elementum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; In mollis, tortor sed pellentesque ultrices, sem sem interdum lectus, a laoreet nulla lacus at risus. Ut placerat orci at enim fermentum, eget pretium ante pharetra. Nam id nunc congue augue feugiat egestas.&lt;/span&gt;', 3, '2020-10-15 15:22:30'),
(4, 'Topic by Admin', '&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-weight: bolder; margin: 0px; padding: 0px; text-align: justify;&quot;&gt;Lorem Ipsum&lt;/span&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; text-align: justify;&quot;&gt;&amp;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&rsquo;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/span&gt;', 1, '2020-10-16 08:31:45'),
(5, 'tcon festival', 'come to the tcon fest!', 5, '2024-07-01 14:00:40'),
(6, 'Are u fr?', 'I am fr', 1, '2024-09-25 08:34:33'),
(7, '123', '123123', 1, '2024-10-08 07:11:12');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(30) NOT NULL,
  `about` text NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `about`, `created`) VALUES
(1, 'Samplee', '2020-10-15 13:08:27'),
(2, 'asdasd', '2020-10-15 13:15:37'),
(3, 'asdasdrtgfdg', '2020-10-15 13:15:45'),
(4, 'dfgdfgdfg', '2020-10-15 13:15:53'),
(5, 'dfgdfgdfg', '2020-10-15 13:16:07');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `cover_img` text NOT NULL,
  `about_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `email`, `contact`, `cover_img`, `about_content`) VALUES
(1, 'St. Paul University Quezon City!', 'info@sample.comm', '+6948 8542 623', '1720099440_436510695_3658226551057264_7499999770068862255_n.jpg', '&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-weight: 400; text-align: justify;&quot;&gt;&amp;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&rsquo;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `img` longblob DEFAULT NULL,
  `name` text NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 3 COMMENT '1=Admin,2=Alumni officer, 3= alumnus',
  `auto_generated_pass` text NOT NULL,
  `alumnus_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `img`, `name`, `username`, `password`, `type`, `auto_generated_pass`, `alumnus_id`) VALUES
(1, '', 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 1, '', 0),
(2, '', 'Julius Cepeda', 'julius123@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 3, '', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alumnus_bio`
--
ALTER TABLE `alumnus_bio`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `studentId` (`studentId`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `career`
--
ALTER TABLE `career`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_commits`
--
ALTER TABLE `event_commits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_comments`
--
ALTER TABLE `forum_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_topics`
--
ALTER TABLE `forum_topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alumnus_bio`
--
ALTER TABLE `alumnus_bio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `career`
--
ALTER TABLE `career`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `event_commits`
--
ALTER TABLE `event_commits`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `forum_comments`
--
ALTER TABLE `forum_comments`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `forum_topics`
--
ALTER TABLE `forum_topics`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
