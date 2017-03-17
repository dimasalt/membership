-- MySQL dump 10.13  Distrib 5.7.17, for Linux (x86_64)
--
-- Host: localhost    Database: membership
-- ------------------------------------------------------
-- Server version	5.7.17-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `checkout_pages`
--

DROP TABLE IF EXISTS `checkout_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `checkout_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `program_id` int(11) NOT NULL DEFAULT '0',
  `price` varchar(10) COLLATE utf32_unicode_ci NOT NULL DEFAULT '0',
  `real_price` varchar(10) COLLATE utf32_unicode_ci DEFAULT NULL,
  `paypal_link` varchar(150) COLLATE utf32_unicode_ci DEFAULT '0',
  `info` varchar(2000) COLLATE utf32_unicode_ci NOT NULL DEFAULT '0',
  `sales_page_info` mediumtext COLLATE utf32_unicode_ci,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `crated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK__programs` (`program_id`),
  CONSTRAINT `FK__programs` FOREIGN KEY (`program_id`) REFERENCES `programs` (`program_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci COMMENT='holds information relevant to program purchaces such as price and other things';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `checkout_pages`
--

LOCK TABLES `checkout_pages` WRITE;
/*!40000 ALTER TABLE `checkout_pages` DISABLE KEYS */;
INSERT INTO `checkout_pages` VALUES (1,1,'47','60','https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=L8RWAEGKUMKMJ',' <h3>Here’s a fraction of what you’ll get…</h3>\r\n            <ul>\r\n                <li>A comprehensive step-by-step system that clearly explains to you how to learn meditation and what meditation use for your anxiety. The only thing you need is to follow steps.</li>\r\n                <li>A natural and medication free approach that you can effectively use to treat anxiety. You don’t have to resort to taking a questionable medication.</li>\r\n                <li>Not just another anxiety self-help program. But a system to combat your anxiety all the way up until your life is changed and you got rid of it entirely.</li>\r\n                <li>Fine tips directly from my 12 years meditation experience that will make a world of difference for your practice. It’s almost like you are learning meditation directly from me face to face.</li>\r\n                <li>17 videos, 17 video script files and a bonus of 5 guided audio meditations (you can upload them into your audio device and meditate anywhere). </li>\r\n                <li>A life time access to a membership website and access to all cumulative updates.</li>\r\n                <li>30 days unconditional money back guarantee. If for any reason whatsoever you don\'t like the program send me an email and I will refund you right on the spot, no questions asked.</li>\r\n                <img src=\"/assets/images/money-back-guarantee.png\" class=\"img-responsive center-block\" style=\"max-width: 30%;\" alt=\"30 days money back guarantee\" />\r\n            </ul>','<div class=\"container-fluid top-alert\">\n        Attention Men And Women Who Struggle With Anxiety\n    </div>\n\n    <div class=\"container-fluid white black-text text-center\">\n        <div class=\"container\">\n            <div class=\"row\">\n                <div class=\"col-lg-9 col-lg-offset-2 margin-bottom-15 border-none\">\n                    <h1>A Powerful 5,000 years Old system to <span>remove anxiety and bring happiness back</span> to your life</h1>\n                </div>\n            </div>\n        </div>\n    </div>\n\n    <div class=\"container-fluid text-white subhead\">\n        <div class=\"container\">\n            <div class=\"row\">\n                <div class=\"col-lg-9 col-lg-offset-2 border-none text-center\">\n                    <strong>A completely natural way that is proven to help even if everything else is failed</strong>\n                </div>\n            </div>\n        </div>\n    </div>\n\n    <div class=\"container-fluid white black-text\">\n        <div class=\"container\">\n            <div class=\"row\">\n                <div class=\"col-lg-9 col-lg-offset-2 side-borders border-bottom z-depth-05\">\n                    <div class=\"clearfix\"></div>\n\n                    <div class=\"col-lg-3 col-md-3 col-sm-4 col-xs-6 margin-top-40 hidden-xs\">\n                        <img src=\"/assets/images/me.png\" class=\"img-responsive\" alt=\"\" />\n                        <div class=\"clearfix\"></div>\n                        <div class=\"text-center margin-top-10\" style=\"line-height: 18px;\">\n                            <small>\n                                <strong>Dmitri Saltanovich</strong><br />\n                                M.Hp, M.NLP, M.TLT and a guy with over 12 years of meditation experience\n                            </small>\n                        </div>\n                    </div>\n                    <div class=\"col-lg-9 col-md-9 col-sm-8 col-xs-12 margin-top-25\">\n                        Dear friend, <br /><br />If you are struggling with anxiety or panic attacks and decided to get your life back, then this is going to be a very important message for you to read. Because I am going to show\n                        you<strong> a natural system to remove anxiety</strong> and get happiness back to your life.\n                        <br />\n                        <br />\n                        But first, lets me share with you a story…\n                    </div>\n\n                    <div class=\"clearfix\"></div>\n\n\n                    <h3>Ending The Nightmare</h3>\n\n                    <img src=\"/assets/images/meditation%20sales%20page/women_in_field.png\" class=\"img-thumbnail img-responsive pull-right margin-left-25\" style=\"width: 35%;\" />\n\n                    <p>Growing up Jenn always knew she was different. She lived with her sister and mother and her parents were divorced. Her father left one day and never came back.</p>\n\n                    <p>She would later discover that her anxiety attacks were triggered by abandonment.</p>\n\n                    <p>On the outside, she was an excellent student with good grades, a talent for music and always with a smile on her face.</p>\n\n                    <p>But on the inside she feared to be alone, unwanted, unpopular, unloved and felt trapped in a nightmare that would never end.</p>\n\n                    <p>Her first anxiety attack happened in a 9th grade. A teacher has asked her to come in front and make a small presentation.</p>\n\n                    <p>Simple enough…</p>\n\n                    <p>But the moment she came to the front a panic attack hit her. She started shaking, feel nauseous and sweating from head to toe.</p>\n\n                    <p>She wanted to run, but couldn\'t.</p>\n\n                    <p>At times when she felt fine, she wondered when her next anxiety attack would hit her. Constant worrying and panicking barely left her\n                        any strength to go through the day.</p>\n\n                    <p>Her mother tried everything she could to help her…</p>\n\n                    <p>She went to a therapist, took a cocktail of multiple medications and even took habit forming classes.</p>\n\n                    <p>But this all only made her feel like a zombie moving through the life.</p>\n                    <p>By the age of 16, she was completely shut socially. Her peers went to parties, played sport and started dating. But she was a prisoner in her own home.</p>\n\n                    <p>She barely managed to finish the high school. But when she went to college her anxiety became so unbearable that she had to drop out.</p>\n\n                    <p>Then one morning her wake-up call came in.</p>\n\n                    <p>She was reading a newspaper; it was an article on meditation. The article described what meditation is, and how it can help people.</p>\n\n                    <p>She decided to give it a try.</p>\n\n                    <p>Over the next few months, she got every book and product on meditation she could lay her hands on.</p>\n\n                    <p>It took her a year, but by the end of this year she was anxiety free, and the nightmare was over.</p>\n\n                    <p>Today her life is completely different, she got back and graduated college, planning to marry her fiancé and looking forward buying her first house.</p>\n\n                    <p>She believes she got lucky on that faithful morning to find a solution to escape her nightmare.</p>\n\n                    <h3>A Secret That Makes Meditation One of The Most Effective Tools For Anxiety And For Panic Attacks</h3>\n\n                    <img src=\"/assets/images/meditation%20sales%20page/The-Power-of-Concentration.jpg\" class=\"img-thumbnail img-responsive pull-left margin-right-25\" style=\"width: 35%;\" />\n\n                    <p>Life offers no magic bullets; we all know that.</p>\n                    <p>But if there is one thing that comes close to it, then it is meditation.</p>\n                    <p>Not only meditation can heal your long term anxiety, but it is also an amazing tool to remove all the negativity you have acquired over the time as a result of anxiety.</p>\n                    <p>Meaning with meditation, you can remove the root cause for your anxiety, but also remove negative feelings and emotions, self-defeating beliefs, internal personality conflicts and negative behavior patterns.</p>\n                    <p><strong>It is a powerful tool, and if you struggle with anxiety, you should learn to use it.</strong></p>\n                    <p>Because it will bring light back to your life.</p>\n                    <p>The reason meditation is so efficient and powerful is because it gives you full control over your mind.</p>\n                    <p>With meditation, you literally can walk into your mind and rearrange or change the things you want.</p>\n                    <p>This means that if you have any other issues you struggle with, physical, emotional or mental you can use meditation to solve them as well.</p>\n\n                    <h3>A Number One Reason Why Meditation Becoming So Popular And People Cannot Stop Praising It Enough</h3>\n\n                    <p>There is a reason why meditation is so popular with people singing praises to it and seemingly cannot get enough of it.</p>\n                    <p>Because it is <strong>a life changer.</strong></p>\n                    <p>In fact, meditation been getting so much attention and popularity that some of the very prominent world institutions came out with their own research on it.</p>\n                    <p>Like two years ago, the University of Toronto (ranked 7th in the world) came out with research with very positive results on how mindfulness meditation is very effective for anxiety.</p>\n                    <p>I know it firsthand because I have met the researcher and took a workshop with him.</p>\n                    <p>In fact, I am going to share with you the exact mindfulness meditation technique that they have used in their research so effectively.</p>\n                    <p>But here is what even more interesting…</p>\n                    <p>Traditional therapists who usually stay away from alternative methods nowadays start to suggest meditation to their patients who struggle with anxiety, panic attacks, and depression.</p>\n                    <p>And it is happening in sweeping numbers.</p>\n                    <p>Even they cannot keep their eyes closed and deny the overwhelming evidence on how powerful and effective meditation is.</p>\n                    <p>But, to use meditation for anxiety, you have to learn it the right way.</p>\n\n\n                    <h3>Why You Almost Guaranteed to Fail to Learn Meditation And How to Fix it</h3>\n                    <img src=\"/assets/images/meditation%20sales%20page/women-meditating.png\" class=\"img-thumbnail img-responsive pull-right margin-left-25\" style=\"width: 35%;\" />\n\n                    <p>If you just starting with meditation or don&rsquo;t have enough experience you are almost guaranteed to fail to learn meditation.</p>\n                    <p>This is because most of the advice out there is a casual, sparkly and a new-age advice.</p>\n                    <p>Advice that makes total sense but wrong at its core.</p>\n                    <p>And if you follow it, it will lead you down to a path of failure, frustration, and regret.</p>\n                    <p>Things that you already have plenty because of anxiety or panic attacks.</p>\n                    <p>I am talking here about advice such as &ldquo;to meditate just sit down, close your eyes and concentrate on something.&rdquo;</p>\n                    <p>Very wrong!</p>\n                    <p>Here, ask yourself if any concentration in your life ever led to meditation?</p>\n                    <p>When you studied at school and concentrated on homework did it ever lead to meditation?</p>\n                    <p>When you are busy and fully concentrated at work did it ever lead to meditation?</p>\n                    <p>When you are reading an interesting book and fully engaged in the process to the point of forgetting about anything around you. Did it ever lead to meditation?</p>\n                    <p>I can continue and give you more examples, but the answer to all of them would be NO.</p>\n\n                    <p>In fact, never before in your life no concentration ever led you to meditation. Or for that matter to any state of mind that can change your life entirely.</p>\n                    <p>This is because to reach meditation it takes a very specific concentration done in a very specific way.</p>\n                    <span class=\"highlight2\"><u>So how would you go about learning meditation?</u></span>\n                    <p>The answer is simple.</p>\n\n                    <img src=\"/assets/images/meditation%20sales%20page/lotus.png\" class=\"img-thumbnail img-responsive pull-left margin-top-20 margin-right-25\" style=\"width: 35%;\" />\n                    <p><strong>It&rsquo;s called a traditional yoga meditation</strong>.</p>\n                    <p>You see, yoga and meditation been around for 5000 years. Meaning it had 500 centuries to develop and perfect a system to learn and practice meditation.</p>\n                    <p>And this traditional system been tested by billions of people and been proven to work exceptionally well.</p>\n                    <p>The thing is, no matter what other people may tell you, meditation is a pinnacle of almost any yoga system. Even big gurus of physically centered yoga systems admit that without meditation their system is only as half as good.</p>\n                    <p>Given that, can anyone really think that to meditate all you need is just sit down and concentrate?</p>\n                    <p>No way! Unless of course you already mastered the art.</p>\n                    <p><strong>That&rsquo;s why the traditional yoga meditation developed a gradual step-by-step system that allows you quickly and surely learn meditation. And no new-age advice will ever come close to it</strong>.</p>\n                    <p>The new-age advice may look logical; it may look convincing, it may make total sense, but it is impractical, misleading and in the long run going only to harm you.</p>\n          \n                    <p>Which brings me to the next important point</p>\n\n\n\n                    <h3>A Complete Guide That Teaches You Everything You Need To Know on Meditation So You Can Change Your Life, Remove Anxiety And Get Your Happiness Back</h3>\n\n                    <img src=\"/assets/images/meditation%20sales%20page/product_box-with_discs.png\" class=\"img-responsive pull-left margin-top-20 margin-right-25\" style=\"width: 35%;\" />\n                    <p>That&rsquo;s why I have decided to take my 12 years of meditation experience and put a traditional yoga meditation system into a program &ldquo;Meditation: A Complete Guide From A to Z&rdquo;.</p>\n                    <p><strong>A program that takes you by hand and step-by-step in a clear-cut manner teaches you exactly how to meditate as well gives you the exact meditations that you need for anxiety.</strong></p>\n                    <p>It assumes that you have no experience at all, and takes you from the very first baby steps all the way up to be a skilled meditation practitioner.</p>\n                    <p>It is a complete reference with all the theory and practice you will ever need. And is specifically designed to remove anxiety and panic attacks from your life.</p>\n                    <p>Below is the list of things you will find in the program:</p>\n                    <ul class=\"sales_page\">\n                        <li><strong>A tool to remove the root cause for your anxiety</strong>, eliminate negative feelings and emotions, change self-defeating beliefs, change unconscious unwanted behaviors and eliminate internal conflicts. All the things that prevent light from coming back to your life.</li>\n                        <li><strong>A program that you can use to heal anxiety as effective as going to therapist with many years of experience.</strong></li>\n                        <li><strong>Completely natural and medication free approach</strong> that you can effectively use to treat anxiety and panic attacks. You don&rsquo;t have to resort to taking a cocktail of questionable medications that alter your brain chemistry.</li>\n                        <li>A page turner and an eye opener that will help you to understand what&rsquo;s going on inside your mind, why you experience anxiety, why it&rsquo;s gets out of control and how to solve the issue.</li>\n                        <li>This is not &ldquo;if you decided to be ok then you will be ok&rdquo; type program, but rather a very practical meditation system created specifically to help with anxiety.</li>\n                        <li>Even the first steps in this program will diminish anxiety, panic attacks, and any depression.</li>\n                        <li><strong>17 videos packed with all the theory, practice and answers you will ever need to successfully learn meditation</strong>. Plus 5 guided audio meditation that you can load into your sound producing device and practice meditation everywhere. </li>\n                        <li><strong>Step by step instructions</strong> to guide you all the way from the very beginning and all the way up to the time when you become good at meditation and can stand you own ground.</li>\n                        <li><strong>Fine and often hidden points for every technique directly from my 12 years&rsquo; experience</strong>. This alone can make a world of difference between successful practice and failed one. You will be learning the right way from the very beginning and avoid making painful mistakes that could keep your meditation practice stagnant or worse create unwanted disruptions for your health, mental and emotional well-being.</li>\n                        <li><strong>Tested by time and practice material</strong>. Every technique or theory piece you get in &ldquo;Meditation: A Complete Guide From A to Z&rdquo; program, I have practiced and experienced myself in my own practice at one time or another. You are getting 100% tested, proven and working material.</li>\n						 <li><strong>Discover a common new age yoga misconceptions and learn how to avoid them</strong>. Nothing wastes time more in meditation than having a wrong information and practicing the wrong way. The information you will find in this program will change your entire approach to how you practice or think about meditation.</li>\n                        <li>\n                            An opportunity to learn directly from experienced meditation practitioner, like if it were face to face. Which is the best way to learn something like this.\n                            <p>This is also your opportunity to look into how a daily practice of experienced meditation practitioner looks like.</p>\n                        </li>\n                        <li><strong>A complete meditation reference</strong> that you can use for years to come. Meditation is like a train, once you get on, you will never get off because you will love it. So, even if you stop practicing for a while eventually you will find your way back anyways and you will have the guide to help you restart</li>                       \n                        <li>Not just another anxiety self-help program. But a system to combat your anxiety all the way up until you got rid of it entirely.</li>\n                        <li>Even if you feel your life is on the decline and can do barely anything, with meditation almost immediately you will find that you have more and more\n                            &ldquo;normal&rdquo; days than before.</li>\n                        <li><strong>Learn how to tackle the heart of your anxiety and get a solution to eliminate it</strong></li>\n                        <li><strong>Rip vast benefits that meditation has to offer</strong> and harvest that power directly into your life to make any issue or struggle to\n                            go away and improve your life the way you want it</li>\n                        <li><strong>Find the inner peace and balance</strong> that will allow you to stand your ground strong and look the life directly into eyes</li>\n                        <li><strong>Be healthier, look younger and live longer</strong>. Meditation makes all those things easily reachable. They are byproduct and you get them even\n                            if you don&rsquo;t try.</li>\n                        <li><strong>Learn techniques that you can put to work immediately</strong>.</li>\n                        <li>An effective tool to free you from a life sentenced to anxiety, be happy again and start waking up with a smile on your face.</li>\n                        <li><strong>30 days unconditional money back guarantee</strong></li>\n                    </ul>\n\n                    <div class=\"col-lg-10 col-lg-offset-1\">\n                        <img src=\"/assets/images/30days%20guarantee.png\" class=\"img-responsive center-block margin-top-25 margin-bottom-20\" />\n                        If for any reason you don’t like the “Meditation: A complete guide from A to Z” program you can send me an email, ask for refund and I will issue a\n                        friendly refund the very dame day. No questions asked.\n                    </div>\n\n                    <div class=\"clearfix\" ></div>\n\n\n                    <h3>An Amazing Bonus: 5 Audio Guided Meditation</h3>\n                   <img src=\"/assets/images/meditation%20sales%20page/guided_meditations_cover.png\" class=\"img-responsive img-thumbnail margin-right-25 pull-left\" style=\"width: 30%\" />\n\n                    <p>You also get 5 guided audio meditation that you can load into your audio device and meditate anywhere.</p>\n                    <p>The meditations you get are:</p>\n                    <ul class=\"col-lg-8 small-margin\">\n                        <li><strong>Quiet The Mind Meditation</strong> - Brings quick ultimate relaxation. Something that is hard to achieve when anxiety and panic attacks are always lurking in a background.</li>\n                        <li><strong>Serenity Meditation</strong> - Get back to your root, find peace and calmness. Almost like if you were laying on the sunny beach, feeling peaceful and enjoying every second of the moment.</li>\n                        <li><strong>Healing Meditation</strong>  - Accelerate healing and boost your energy. An incredible fix for times when you feel tired, exhausted or drained out. Also great for times when you have a lot on your plate and need to recharge.</li>\n                        <li><strong>Higher Power Meditation</strong> - Nothing is more blissful in this world than being connected and tuned with yourself. It is at this times that you have the utmost confidence to stand your ground strong and reach for the stars.</li>\n                        <li><strong>Potential Meditation</strong> - Unleash your hidden inner potential and be able to accomplish things you only dreamed about.</li>\n                    </ul>\n                   <div class=\"clearfix\"></div>\n\n                    <div class=\"margin-top-40\"></div>\n                    <a href=\"/order/checkout/1\" class=\"\">\n                        <div class=\"text-center margin-bottom-15\" style=\"font-size: 42px\">\n                            <s class=\"red-text margin-right-25\">$60</s>\n                            <span class=\"blue-text\">$47</span>\n                        </div>\n                        <img src=\"/assets/images/Buy-Now-Button.png\" class=\"img-responsive center-block margin-bottom-40\" />\n                    </a>\n                    <div class=\"clearfix\" ></div>\n\n\n                    <h3 style=\"margin-top:85px;\">A Way To Treat Anxiety And Panic Attacks Like if You Were Going To an Experienced Therapist And it Doesn’t Involve Medication.</h3>\n\n                    <p>You and I know you did not choose to have anxiety and panic attacks. It just happened and is no fault of yours.</p>\n                    <p>But now that you have it, you have to do something about it.</p>\n\n                    <p>The question is what will it be.</p>\n\n                    <p>Until now, you have tried to cope with it while you search and apply random solutions and fixes. All while being at risk of anxiety getting larger and\n                        larger until it takes over your life entirely. Perhaps even evolving into something bigger like depression.</p>\n                    \n                    <p><strong>That was the past&hellip;</strong></p>\n\n                    <p><strong>But now, you have a solution that works, very efficient and is right in front of you. The solution that already helped to a lot of people continues to help\n                        and every day gets more and more recognition.</strong></p>\n\n                    <p>Here is the thing. I know you are serious about changing your life and removing anxiety. Otherwise, you wouldn\'t read this message and get to this point.</p>\n\n                    <p>So if I am right, then here is what you should do next&hellip;</p>\n\n                    <p>Click the button below, get the &ldquo;Meditation: A Complete Guide From A to Z&rdquo; program and start practicing it right away.</p>\n\n                    <p>Because the sooner you start, the more and more normal days you will start to have. Until one day the anxiety and the panic attacks a completely gone.</p>\n\n                    <p>Then, one day in the future when you look back and realize the right decision you have made and the life that you have created as a result of this decision,\n                        you will feel very proud of your achievement. And rightfully so.</p>\n\n                    <div class=\"clearfix margin-top-40\"></div>\n                    <a href=\"/order/checkout/1\" class=\"\">\n                        <div class=\"text-center margin-bottom-15\" style=\"font-size: 42px\">\n                            <s class=\"red-text margin-right-25\">$60</s>\n                            <span class=\"blue-text\">$47</span>\n                        </div>\n                        <img src=\"/assets/images/Buy-Now-Button.png\" class=\"img-responsive center-block margin-bottom-40\" />\n                    </a>\n                    <div class=\"clearfix\" ></div>\n\n                    <p><u>P.S:</u> <strong>Remember the program is totally risk-free and comes with 30 days&rsquo; unconditional money back guarantee</strong>. If you don&rsquo;t like it for whatever reason, just send me an email, and I will issue a friendly refund the very same day. No question asked.</p>\n\n                    <p><u>P.S.S:</u> <strong>The program comes with an email support, and I encourage you to take a full advantage of it</strong>. Having somebody with 12 years of experience guiding you through the process and helping you out is indispensable. Because not only I am experienced meditation practitioner but I also an alternative health therapist who helps people with anxiety in real life in my private practice.&nbsp;</p>\n\n                    <p>So you get a double benefit. Make sure to use it to your advantage.</p>\n\n                    <p><u>P.S.S:</u> This is not an overnight magic solution. But a complete meditation system designed to help you overcome anxiety and panic attacks in a gradual, with your full control and in an entirely natural way.&nbsp;</p>\n					\n					<p><u>P.S.S.S:</u> The price is only $47 which is an introductory price and if you ask me a complete bargain. Most of the meditation programs cost well over $100 and going to yoga teacher might run a cost of $150 for 1 hour.</p>\n					\n					<p>Here you have a system to take care of anxiety through meditation and change your life. A system that teaches you step by step everything you need to know. You don’t have to spend big money or go out of your way to learn meditation. You can do it in convenience and privacy of your home.</p>\n					\n					<p>But the price is not going to last long. Once the introduction period is over I will soon change it to a higher one.</p>\n					\n					<p>So grab it with price reduction while you can.</p>\n                </div>\n            </div>\n        </div>\n    </div>','2016-10-16 21:39:39','2016-09-18 06:56:17');
/*!40000 ALTER TABLE `checkout_pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `page` varchar(50) NOT NULL,
  `action` varchar(150) NOT NULL,
  `agent` varchar(250) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (18,'dmitri@better-life-tips.com','Logout','logged out','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36','38.122.184.202','2017-02-28 17:17:00'),(19,'dmitri@better-life-tips.com','Login Page','login','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36','38.122.184.202','2017-03-01 14:21:35'),(20,'dmitri@better-life-tips.com','Logout','logged out','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36','38.122.184.202','2017-03-01 14:40:27'),(21,'dmitri@better-life-tips.com','Login Page','login','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36','38.122.184.202','2017-03-01 20:18:55'),(22,'dmitri@better-life-tips.com','Logout','logged out','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36','38.122.184.202','2017-03-01 20:19:10'),(23,'dmitri@better-life-tips.com','Login Page','login','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36','38.122.184.202','2017-03-02 13:48:40'),(24,'dmitri@better-life-tips.com','Login Page','login','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36','38.122.184.202','2017-03-02 13:48:40'),(25,'dmitri@better-life-tips.com','Logout','logged out','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36','38.122.184.202','2017-03-02 13:48:43'),(26,'dmitri@better-life-tips.com','Login Page','login','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36','38.122.184.202','2017-03-02 13:48:51'),(27,'dmitri@better-life-tips.com','Logout','logged out','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36','38.122.184.202','2017-03-02 13:58:12'),(28,'dmitri@better-life-tips.com','Login Page','login','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36','38.122.184.202','2017-03-03 14:12:43'),(29,'dmitri@better-life-tips.com','Program page','Visited program: Meditation: A Complete Guide','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36','38.122.184.202','2017-03-03 14:12:45'),(30,'dmitri@better-life-tips.com','Program page','Visited program: Meditation: A Complete Guide, item: Benefits of meditation','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36','38.122.184.202','2017-03-03 14:12:48'),(31,'dmitri@better-life-tips.com','Logout','logged out','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36','38.122.184.202','2017-03-03 14:13:08'),(32,'dmitri@better-life-tips.com','Login Page','login','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36','38.122.184.202','2017-03-03 20:20:18'),(33,'dmitri@better-life-tips.com','Login Page','login','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36','38.122.184.202','2017-03-03 20:20:18'),(34,'dmitri@better-life-tips.com','Logout','logged out','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36','38.122.184.202','2017-03-03 20:20:24'),(35,'dmitri@better-life-tips.com','Login Page','login','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36','38.122.184.202','2017-03-03 20:20:33'),(36,'dmitri@better-life-tips.com','Program page','Visited program: Meditation: A Complete Guide','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36','38.122.184.202','2017-03-03 20:20:36'),(37,'dmitri@better-life-tips.com','Program page','Visited program: Meditation: A Complete Guide, item: Your practice diet','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36','38.122.184.202','2017-03-03 20:20:39'),(38,'dmitri@better-life-tips.com','Program page','Visited program: Meditation: A Complete Guide, item: Your practice diet','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36','38.122.184.202','2017-03-03 20:20:45'),(39,'dmitri@better-life-tips.com','Program page','Visited program: Meditation: A Complete Guide','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36','38.122.184.202','2017-03-03 20:21:10'),(40,'dmitri@better-life-tips.com','Logout','logged out','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36','38.122.184.202','2017-03-03 20:21:14');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_ban_list`
--

DROP TABLE IF EXISTS `order_ban_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_ban_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='Table containing repeated refund offenders';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_ban_list`
--

LOCK TABLES `order_ban_list` WRITE;
/*!40000 ALTER TABLE `order_ban_list` DISABLE KEYS */;
INSERT INTO `order_ban_list` VALUES (1,'annalopez0989@gmail.com','Anna','Lopez','2016-11-11 20:53:59'),(2,'sarahoshea73@gmail.com','sarah','Rye','2016-11-11 20:54:24');
/*!40000 ALTER TABLE `order_ban_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_buyers`
--

DROP TABLE IF EXISTS `order_buyers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_buyers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `txn_id` varchar(100) NOT NULL DEFAULT '0',
  `email` varchar(50) DEFAULT '0',
  `fname` varchar(50) DEFAULT '0',
  `lname` varchar(50) DEFAULT '0',
  `address` varchar(50) DEFAULT '0',
  `state` varchar(50) DEFAULT '0',
  `country` varchar(50) DEFAULT '0',
  `postal` varchar(50) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_buyer_details_orders` (`txn_id`),
  CONSTRAINT `FK_buyer_details_orders` FOREIGN KEY (`txn_id`) REFERENCES `order_transactions` (`txn_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_buyers`
--

LOCK TABLES `order_buyers` WRITE;
/*!40000 ALTER TABLE `order_buyers` DISABLE KEYS */;
INSERT INTO `order_buyers` VALUES (1,'7FW31257T7281643Y','chini_ahmed@yahoo.com','Shirin','Ahmed',',','','','','2016-10-11 19:18:20'),(2,'34060549939232934','chini_ahmed@yahoo.com','Shirin','Ahmed',',','','','','2016-10-11 19:27:57'),(3,'ch_193XPlDSctTUOkbxYweXQoHN.charge.succeeded','lbrierley07@aol.com','Louise Batt','','23 Mayfields Drive,Walsall','West Midlands','United Kingdom','WS8 7NJ','2016-10-11 21:03:59'),(4,'4UR62172LW600552Y','annalopez0989@gmail.com','Anna','Lopez',',','','','','2016-10-12 14:02:52'),(5,'ch_194CiSDSctTUOkbxtWMBJtRp.charge.succeeded','tamala171980@yahoo.com','Tammy Markus','','W2697 County Road PPP,Sheboygan Falls','Wisconsin','United States','53085','2016-10-13 17:10:02'),(6,'2U991347GW247113A','sarahoshea73@gmail.com','sarah','Rye',',','','','','2016-10-14 12:51:14'),(7,'ch_194wswDSctTUOkbxriqcZIeQ.charge.succeeded','pbrooks1960@gmail.com','penny brookshire','','23378 E 28th Rd.,Rosamond','IL.','United States',' 62083','2016-10-15 18:27:56'),(8,'ch_196LAQDSctTUOkbxQ1cpwarm.charge.succeeded','lalmaas@shaw.ca','Lisa Almaas','','206 Larsen Ave,Endberby','British Columbia','Canada','V0E1V2','2016-10-19 14:35:43'),(9,'ch_196RjiDSctTUOkbx35ZzdPoA.charge.succeeded','Susanfreeman1@hotmail.com','Susan Freeman','','34 westcotts green, ,Warfield','Berkshire','United Kingdom','Rg42 3sg','2016-10-19 21:36:36'),(10,'6R343401G8441360U','sarahoshea73@gmail.com','sarah','Rye',',','','','','2016-10-25 22:04:34'),(11,'1S367423VG547633M','dbudgetmarketing@gmail.com','Daniel','Bone',',','','','','2016-10-26 20:37:51'),(12,'3V841861KE352725X','annalopez0989@gmail.com','Anna','Lopez',',','','','','2016-11-11 15:24:06');
/*!40000 ALTER TABLE `order_buyers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_transactions`
--

DROP TABLE IF EXISTS `order_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_transactions` (
  `txn_id` varchar(100) NOT NULL,
  `txn_type` varchar(50) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `payment_source` varchar(50) NOT NULL,
  `item_name` varchar(150) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`txn_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_transactions`
--

LOCK TABLES `order_transactions` WRITE;
/*!40000 ALTER TABLE `order_transactions` DISABLE KEYS */;
INSERT INTO `order_transactions` VALUES ('1S367423VG547633M','web_accept','instant','Completed','PayPal','Instant Anxiety Relief','26.00','2016-10-26 20:37:51'),('2U991347GW247113A','web_accept','instant','Completed','PayPal','Meditation: A Complete Guide From A to Z','47.00','2016-10-14 12:51:14'),('34060549939232934','web_accept','instant','Completed','PayPal','Meditation: A Complete Guide From A to Z','47.00','2016-10-11 19:27:57'),('3V841861KE352725X','','instant','Refunded','PayPal','Meditation: A Complete Guide From A to Z','-47.00','2016-11-11 15:24:06'),('4UR62172LW600552Y','web_accept','instant','Completed','PayPal','Meditation: A Complete Guide From A to Z','47.00','2016-10-12 14:02:52'),('6R343401G8441360U','','instant','Refunded','PayPal','Meditation: A Complete Guide From A to Z','-47.00','2016-10-25 22:04:34'),('7FW31257T7281643Y','web_accept','instant','Completed','PayPal','Meditation: A Complete Guide From A to Z','47.00','2016-10-11 19:18:20'),('ch_193XPlDSctTUOkbxYweXQoHN.charge.succeeded','charge','charge.succeeded','succeeded','Stripe','Meditation: A Complete Guide From A to Z','47','2016-10-11 21:03:59'),('ch_194CiSDSctTUOkbxtWMBJtRp.charge.succeeded','charge','charge.succeeded','succeeded','Stripe','Meditation: A Complete Guide From A to Z','47','2016-10-13 17:10:02'),('ch_194wswDSctTUOkbxriqcZIeQ.charge.succeeded','charge','charge.succeeded','succeeded','Stripe','Meditation: A Complete Guide From A to Z','47','2016-10-15 18:27:56'),('ch_196LAQDSctTUOkbxQ1cpwarm.charge.succeeded','charge','charge.succeeded','succeeded','Stripe','Meditation: A Complete Guide From A to Z','47','2016-10-19 14:35:43'),('ch_196RjiDSctTUOkbx35ZzdPoA.charge.succeeded','charge','charge.succeeded','succeeded','Stripe','Meditation: A Complete Guide From A to Z','47','2016-10-19 21:36:36');
/*!40000 ALTER TABLE `order_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `program_item_files`
--

DROP TABLE IF EXISTS `program_item_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `program_item_files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL DEFAULT '0',
  `folder` varchar(300) NOT NULL,
  `file` varchar(150) NOT NULL,
  `name` varchar(150) NOT NULL DEFAULT '0',
  `type` varchar(5) NOT NULL DEFAULT '0',
  `place` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`file_id`),
  KEY `FK_program_item_files_program_items` (`item_id`),
  CONSTRAINT `FK_program_item_files_program_items` FOREIGN KEY (`item_id`) REFERENCES `program_items` (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COMMENT='keeps item files that members can download\r\n\r\ntypes can be:\r\nmp3\r\npdf,\r\nmp4';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `program_item_files`
--

LOCK TABLES `program_item_files` WRITE;
/*!40000 ALTER TABLE `program_item_files` DISABLE KEYS */;
INSERT INTO `program_item_files` VALUES (1,1,'meditation a complete guide from a to z','1. Welcome.pdf','Welcome.pdf','pdf',2,'2016-05-13 08:29:21'),(2,2,'meditation a complete guide from a to z','2. Why meditation and what you need to succeed.pdf','Why meditation and what you need to succeed.pdf','pdf',2,'2016-08-06 04:01:30'),(3,3,'meditation a complete guide from a to z','3. Benefits of meditaiton.pdf','Benefits of meditaiton.pdf','pdf',2,'2016-08-06 04:01:30'),(4,4,'meditation a complete guide from a to z','4. Your practice diet.pdf','Your practice diet.pdf','pdf',2,'2016-08-06 04:01:30'),(5,5,'meditation a complete guide from a to z','5. Positions for meditation.pdf','Positions for meditation.pdf','pdf',2,'2016-08-06 04:01:30'),(7,7,'meditation a complete guide from a to z','6. Breathing Theory.pdf','Breathing Theory.pdf','pdf',2,'2016-08-06 04:01:30'),(8,8,'meditation a complete guide from a to z','6.1 Basic breathing practice.pdf','Basic breathing practice.pdf','pdf',2,'2016-08-06 04:01:30'),(9,9,'meditation a complete guide from a to z','6.2 Working with nadi channels.pdf','Working with nadi channels.pdf','pdf',2,'2016-08-06 04:01:30'),(10,10,'meditation a complete guide from a to z','6.3 Grounding breathing technique.pdf','Grounding breathing technique.pdf','pdf',2,'2016-08-06 04:01:30'),(11,6,'meditation a complete guide from a to z','7. Relaxation.pdf','Relaxation.pdf','pdf',2,'2016-08-06 04:01:30'),(12,11,'meditation a complete guide from a to z','8. Concentration.pdf','Concentration.pdf','pdf',2,'2016-08-06 04:01:30'),(13,12,'meditation a complete guide from a to z','8.1 Two techniques for concentration.pdf','Two techniques for concentration.pdf','pdf',2,'2016-08-06 04:01:30'),(14,13,'meditation a complete guide from a to z','9. Meditation theory.pdf','Meditation theory.pdf','pdf',2,'2016-08-06 04:01:30'),(15,14,'meditation a complete guide from a to z','9.1 Mindfulness meditation.pdf','Mindfulness meditation.pdf','pdf',2,'2016-08-06 04:01:30'),(16,15,'meditation a complete guide from a to z','9.2 Grounding meditation.pdf','Grounding meditation.pdf','pdf',2,'2016-08-06 04:01:30'),(17,16,'meditation a complete guide from a to z','9.3 Meditation with AOUM.pdf','Meditation with AOUM.pdf','pdf',2,'2016-08-06 04:01:30'),(19,17,'meditation a complete guide from a to z','10. What next.pdf','What next.pdf','pdf',2,'2016-08-06 04:01:30'),(20,18,'meditation a complete guide from a to z/guided meditations','Healing.mp3','Healing.mp3','mp3',1,'2016-08-06 04:01:30'),(21,18,'meditation a complete guide from a to z/guided meditations','Higher Power.mp3','Higher Power.mp3','mp3',1,'2016-08-06 04:01:30'),(22,18,'meditation a complete guide from a to z/guided meditations','Potential.mp3','Potential.mp3','mp3',1,'2016-08-06 04:01:30'),(23,18,'meditation a complete guide from a to z/guided meditations','Quiet The Mind.mp3','Quiet The Mind.mp3','mp3',1,'2016-08-06 04:01:30'),(24,18,'meditation a complete guide from a to z/guided meditations','Serenity.mp3','Serenity.mp3','mp3',1,'2016-08-06 04:01:30'),(25,1,'meditation a complete guide from a to z','1. Welcome.mp4','Welcome.mp4','mp4',1,'2017-02-12 03:45:11'),(26,2,'meditation a complete guide from a to z','2. Why meditation.mp4','Why meditation.mp4','mp4',1,'2016-08-06 04:01:30'),(27,3,'meditation a complete guide from a to z','3. Benefits of meditation.mp4','Benefits of meditation.mp4','mp4',1,'2016-08-06 04:01:30'),(28,4,'meditation a complete guide from a to z','4. Your practice diet.mp4','Your practice diet.mp4','mp4',1,'2016-08-06 04:01:30'),(29,5,'meditation a complete guide from a to z','5. Positions.mp4','Positions.mp4','mp4',1,'2016-08-06 04:01:30'),(30,6,'meditation a complete guide from a to z','7. Relaxation (Pratyahara).mp4','Relaxation (Pratyahara).mp4','mp4',1,'2016-08-06 04:01:30'),(31,7,'meditation a complete guide from a to z','6. Breathing (pranayama) theory.mp4','Breathing (pranayama) theory.mp4','mp4',1,'2016-08-06 04:01:30'),(32,8,'meditation a complete guide from a to z','6.1 Basic breathing exercise.mp4','Basic breathing exercise.mp4','mp4',1,'2016-08-06 04:01:30'),(33,9,'meditation a complete guide from a to z','6.2 Breathing-working with energy and nadi.mp4','Breathing-working with energy and nadi.mp4','mp4',1,'2016-08-06 04:01:30'),(34,10,'meditation a complete guide from a to z','6.3 Breathing - Grounding Technique.mp4','Breathing - Grounding Technique.mp4','mp4',1,'2016-08-06 04:01:30'),(35,11,'meditation a complete guide from a to z','8. Concentration.mp4','Concentration.mp4','mp4',1,'2016-08-06 04:01:30'),(36,12,'meditation a complete guide from a to z','8.1 Concentration Practice.mp4','Concentration Practice.mp4','mp4',1,'2016-08-06 04:01:30'),(37,13,'meditation a complete guide from a to z','9. Meditation theory.mp4','Meditation theory.mp4','mp4',1,'2016-08-06 04:01:30'),(38,14,'meditation a complete guide from a to z','9.1 Mindfulness Meditation.mp4','Mindfulness Meditation.mp4','mp4',1,'2016-08-06 04:01:30'),(39,15,'meditation a complete guide from a to z','9.2 A perfect inner balance.mp4','A perfect inner balance.mp4','mp4',1,'2016-08-06 04:01:30'),(40,16,'meditation a complete guide from a to z','9.3 Meditation with AOUM.mp4','9.3 Meditation with AOUM.mp4','mp4',1,'2016-08-06 04:01:30'),(41,17,'meditation a complete guide from a to z','10. What next.mp4','What next.mp4','mp4',1,'2016-08-06 04:01:30');
/*!40000 ALTER TABLE `program_item_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `program_items`
--

DROP TABLE IF EXISTS `program_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `program_items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `program_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `folder` varchar(300) DEFAULT NULL,
  `file` varchar(250) DEFAULT NULL,
  `description` varchar(750) DEFAULT NULL,
  `type` varchar(30) NOT NULL,
  `place` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`item_id`),
  KEY `FK_product_files_products` (`program_id`),
  KEY `FK_program_items_program_items_category` (`category_id`),
  CONSTRAINT `FK_product_files_products` FOREIGN KEY (`program_id`) REFERENCES `programs` (`program_id`) ON DELETE CASCADE,
  CONSTRAINT `FK_program_items_program_items_category` FOREIGN KEY (`category_id`) REFERENCES `program_items_category` (`category_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COMMENT='contains list and locations of product related files\r\n\r\nItem types are :\r\nvideo\r\ntext\r\n';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `program_items`
--

LOCK TABLES `program_items` WRITE;
/*!40000 ALTER TABLE `program_items` DISABLE KEYS */;
INSERT INTO `program_items` VALUES (1,1,1,' Welcome','meditation a complete guide from a to z','1. Welcome.mp4','An introduction video that explains what this program is all about, the structure and what are you going to learn. A detailed description and explanation of every part of this program.','video',1,'2016-05-13 03:11:43'),(2,1,1,'Why meditation and what you need to succeed','meditation a complete guide from a to z','2. Why meditation.mp4','Meditation is a powerfull tool but it takes a practice to learn and to succeed. <br /><br />\r\n\r\nIn today video we are going to learn what makes meditation so powerfull, how to find you true motivation (that will be there with you even a year from now) and the number one thing you need to progress quickly.\r\n','video',2,'2016-05-13 03:12:24'),(3,1,1,'Benefits of meditation','meditation a complete guide from a to z','3. Benefits of meditation.mp4','You know meditation is good for you. <br /><br />\r\n\r\nLike everybody else you heard it many times, maybe even met people whom miraculously turned their health and life around with help of meditation.<br /><br />\r\n\r\nBut why and how often stays unclear. That why this video exists, we going to answer those unanswered question.<br /><br />\r\n\r\nThis will not only give us answers, but also serve as a motivation.\r\n\r\n','video',3,'2016-05-13 03:13:01'),(4,1,1,'Your practice diet','meditation a complete guide from a to z','4. Your practice diet.mp4','We are what we eat <br /><br />\r\n\r\nI don\'t think there is a single person who thinks otherwise. Therefore we well know that if food does affects our day to day life, it only makes a sense that it going to affect our meditation practice<br /><br />\r\n\r\nActually food and a right diet can not only change your practice, but can be a make a difference between successfull practice and failed one.<br /><br />\r\n\r\nLuckily for us in this program we don\'t have special diet requirements. <br /><br />\r\n\r\nBut we do have some guidelines. Nothing special, just a common sense things that are good to do.<br /><br />\r\n\r\nThis video will give you a guidance and some fine point for your meditation practice eating habbits.','video',4,'2016-05-13 03:13:29'),(5,2,1,'What is the right postion for your meditation practice','meditation a complete guide from a to z','5. Positions.mp4','Taking and keeping right poistion trough your meditation practice is very important. <br /><br />\r\n\r\nNot only bad position will negatively affect your meditation, but it can also pose a danger to your health.<br /><br />\r\n\r\nToday we going to learn available position for meditation as well what makes a pose to be a good pose. We also going to touch on some fine points. ','video',1,'2016-05-13 03:14:04'),(6,3,1,'Relaxation','meditation a complete guide from a to z','7. Relaxation (Pratyahara).mp4','Relaxation is a foundation on which you going to build your more advanced skills such as concentration and meditation.<br />\r\n\r\nYoga relaxation is not like regular relaxation we all know and used to, yoga relaxation goes step further and deeper. <br /><br />\r\n\r\nUnlike normal life relaxation, yoga relaxation will give you greater control over your body and state of mind. For many people, when they finally reach proper yoga relaxation it is \r\ntheir firts time when they actually have a full control over what happens with them.','video',1,'2016-05-13 03:15:14'),(7,4,1,'Breathing (pranayama) theory','meditation a complete guide from a to z','6. Breathing (pranayama) theory.mp4','Breathing is one of those things that your going to practice and work on all the way until you reach meditation.<br /><br />\r\n\r\nBecause breathing is a very important aspect of your practice. <br /><br />\r\n\r\nYou see, breathing is not just breathing but also a way to control your mind (they control each other), and energies in your body. <br /><br />\r\n\r\nA proper breathing exercies have very positive effect on your health and well being. \r\n\r\n','video',1,'2016-05-13 03:15:47'),(8,4,1,'Basic breathing exercise','meditation a complete guide from a to z','6.1 Basic breathing exercise.mp4','An easy and basic breathing exercise to give you a good foundation and understanding for this type of exercises. <br /><br />\r\n\r\nThis exercise will help you to calm down your body, emotions. It will also help you to slow down mind so that you can use this freed energy to achieve other things.','video',2,'2016-05-13 03:16:22'),(9,4,1,'Working with Nadi channels','meditation a complete guide from a to z','6.2 Breathing-working with energy and nadi.mp4','Nadi\'s a sacred energy channels trough which energy freely flows in your body.<br /><br />\r\n\r\nThis exercise will help you direct this energy.<br /><br />\r\n\r\nA very good exercise that will positivelly affect your health and your wellbeing.','video',3,'2016-05-13 03:16:52'),(10,4,1,'Breathing grounding technique','meditation a complete guide from a to z','6.3 Breathing - Grounding Technique.mp4',' A simple yet effective grounding technique. <br />\r\n\r\nIf you happen to struggle with anxiety, depression, stress and emotional dissbalance this exercise can help you to calm these.','video',4,'2016-05-13 03:17:26'),(11,5,1,'Concentration theory','meditation a complete guide from a to z','8. Concentration.mp4','This is an advanced topic. <br />\r\nThis is where you start you journey within and to the concentration. In fact you are one step away from it.<br /><br />\r\n\r\n\r\nIn this video we going to cover concentration and what kind of concentration you should have so it naturally flows into meditation. <br />\r\n\r\nAdditionally, I will explain why concentration is not a meditation.','video',1,'2016-05-14 07:13:31'),(12,5,1,'Concentration, two practical techniques','meditation a complete guide from a to z','8.1 Concentration Practice.mp4','Two traditional yoga techniques to work on your concentration skills.<br />\r\nBoth are designed in a way that you can practice them anywhere and at any time provided you have few minutes to spare.<br /><br />\r\n\r\nMake sure to chose one of the technique and practice it as much as possible.<br />\r\nThe more you practice the better you will get.<br /><br />\r\n\r\nOnce you start practicing you will very soon notice how your memory improves, how easier it is to concentrate on a day to day things. How easy it is to learn thing and how your \r\nmind always sharp.<br />\r\n\r\nAs you continue to practice concentration you will realize that your mind and your inner being becomes more and more relaxed and quiet.','video',2,'2016-05-14 07:14:20'),(13,6,1,'Meditation theory','meditation a complete guide from a to z','9. Meditation theory.mp4','A king of any yoga practice.<br />\r\n\r\nWithout meditation no yoga is complete and no yoga is effective. Like the saying goes \"all roads lead to Rome\", same with yoga, all roads lead to meditation. <br /><br />\r\n\r\nThis is the part of our program that is going to change, transform and make everything else in your life better.<br /><br />\r\n\r\nP.S: Before you start with this section of program make sure you learned and practice material and exercises from all other previous videos.','video',1,'2016-05-14 07:15:32'),(14,6,1,'Mindfulness meditation','meditation a complete guide from a to z','9.1 Mindfulness Meditation.mp4','One of the easiest, yet very effective meditations, and is a great way to start your meditation journey. <br /><br />\r\n\r\nThis meditation is great to practice to unwind and calm down anxiety or depression. It also helps to overcome stress, negative emotions, limiting beliefs or change behavioural patterns that you feel stack in.','video',2,'2016-05-14 07:16:09'),(15,6,1,'Grounding meditation (perfect inner balance)','meditation a complete guide from a to z','9.2 A perfect inner balance.mp4','An ancient tantric meditation to help you find a perfect inner balance. <br /><br />\r\n\r\nWhen that inner balance is achieved it will reflect back on your health; both emotional and physical. <br /><br />\r\n\r\n\r\n','video',3,'2016-05-14 07:16:58'),(16,6,1,'Meditation with AOUM','meditation a complete guide from a to z','9.3 Meditation with AOUM.mp4','A slightly more advanced meditation technique to give you sense of what is possible.<br /><br />\r\nThis technique incorporates meditation with use of energy channels and mantras and is great for your physical health and will increase an overall quality of your life.','video',4,'2016-05-14 07:17:32'),(17,7,1,'What next','meditation a complete guide from a to z','10. What next.mp4','A final words and some advice to where you can take your journey of meditation if you want to continue to more advanced practice of meditation.','video',1,'2016-05-14 07:18:57'),(18,8,1,'Guided audio meditations',NULL,NULL,'Guided audio meditation that you can load on to your mobile phone or ipad and listen. These intended to help you and guide you on your meditation journey.\r\n<br /><br />\r\n<u>Guided audio meditation include:</u><br />\r\n1. Healing.mp3 - for accelerated healing<br />\r\n2. Higher Power.mp3 - to discover your true self<br />\r\n3. Potential.mp3 - to unleash your hidden potential<br />\r\n4. Quiet the Mind.mp3 - for ultimate relaxation <br />\r\n5. Serenity.mp3 - to achieve an inner peace <br />\r\n\r\n<br />\r\nEnjoy\r\n\r\n<br /><br />\r\n<strong>\r\nTo download right click on the link and select \"Save As\" or \"Save Link As\" option from the menu.\r\n</strong>','text',1,'2016-08-05 00:26:37'),(19,9,4,'Theory module','meditation a complete guide from a to z',NULL,NULL,'video',0,'2016-08-05 02:09:25'),(20,10,4,'Practice Module','meditation a complete guide from a to z',NULL,NULL,'video',0,'2016-08-05 02:10:00');
/*!40000 ALTER TABLE `program_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `program_items_category`
--

DROP TABLE IF EXISTS `program_items_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `program_items_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `program_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `place` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`category_id`),
  KEY `FK_program_items_category_programs` (`program_id`),
  CONSTRAINT `FK_program_items_category_programs` FOREIGN KEY (`program_id`) REFERENCES `programs` (`program_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='contains items category/sections/headlines for the program items';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `program_items_category`
--

LOCK TABLES `program_items_category` WRITE;
/*!40000 ALTER TABLE `program_items_category` DISABLE KEYS */;
INSERT INTO `program_items_category` VALUES (1,1,'Theory of meditation',1,'2016-05-10 21:54:15','2016-05-10 21:54:15'),(2,1,'Poses',2,'2016-05-10 21:54:37','2016-05-10 21:54:37'),(3,1,'Relaxation (Pratyahara)',4,'2016-05-14 07:54:09','2016-05-10 21:55:08'),(4,1,'Breathing exercises (Pranayama)',3,'2016-05-14 07:54:06','2016-05-10 21:55:32'),(5,1,'Concentration(Dharana)',5,'2016-05-10 21:56:15','2016-05-10 21:56:15'),(6,1,'Meditation (Dhyana)',6,'2016-05-14 07:12:46','2016-05-14 07:11:40'),(7,1,'What Next',7,'2016-05-14 07:18:26','2016-05-14 07:18:26'),(8,1,'Bonuses',8,'2016-07-28 19:12:52','2016-07-28 19:12:52'),(9,4,'Theory',1,'2016-08-05 02:06:55','2016-08-05 02:06:55'),(10,4,'Practice',2,'2016-08-05 02:07:22','2016-08-05 02:07:22'),(11,4,'Bonuses',3,'2016-08-05 02:07:42','2016-08-05 02:07:42');
/*!40000 ALTER TABLE `program_items_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `programs`
--

DROP TABLE IF EXISTS `programs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `programs` (
  `program_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `full_name` varchar(250) DEFAULT NULL,
  `excert` varchar(500) DEFAULT NULL,
  `program_img` varchar(250) DEFAULT NULL,
  `sales_url` varchar(150) DEFAULT NULL,
  `is_published` tinyint(4) NOT NULL DEFAULT '0',
  `is_free` tinyint(4) NOT NULL DEFAULT '0',
  `place` int(11) NOT NULL DEFAULT '1',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`program_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COMMENT='table containing list of available products and their description';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `programs`
--

LOCK TABLES `programs` WRITE;
/*!40000 ALTER TABLE `programs` DISABLE KEYS */;
INSERT INTO `programs` VALUES (1,'Meditation: A Complete Guide','Meditation: A Complete Guide From A to Z','Your one-stop meditation reference. A step-by-step guide with all the theory and practice you need to successfully learn and master meditation and harvest it power into your life.','/assets/images/meditation-guide.png','/sp/1',1,0,1,'2016-10-08 02:49:57','2016-05-04 22:55:16'),(3,'3 Life Chaning Tips',NULL,'A very practical and effective way to address self-image, negative feelings and behaviours and transform them almost in an instant. This method works even if everything else failed.','/assets/images/meditation-guide.png',NULL,0,0,3,'2016-07-28 15:01:18','2016-05-04 22:55:16'),(4,'Instant Anxiety Relief',NULL,'A method to safely got to the root cause and the core reason for your anxiety and remove it. This method is safe, effective and works incredibly quick.','/assets/images/meditation-guide.png',NULL,0,0,2,'2016-08-05 02:11:05','2016-05-26 18:58:29');
/*!40000 ALTER TABLE `programs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `programs_to_users`
--

DROP TABLE IF EXISTS `programs_to_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `programs_to_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` char(50) NOT NULL,
  `program_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_products_to_users_users` (`user_id`),
  KEY `FK_products_to_users_products` (`program_id`),
  CONSTRAINT `FK_products_to_users_products` FOREIGN KEY (`program_id`) REFERENCES `programs` (`program_id`) ON DELETE CASCADE,
  CONSTRAINT `FK_products_to_users_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COMMENT='list of users and their respective purchased products';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `programs_to_users`
--

LOCK TABLES `programs_to_users` WRITE;
/*!40000 ALTER TABLE `programs_to_users` DISABLE KEYS */;
INSERT INTO `programs_to_users` VALUES (1,'22923410-00d9-11e6-b4b9-18a905b8e8d0',1,'2016-05-09 18:17:59'),(2,'575eda2a7bb4f0.03138049',1,'2016-06-13 20:09:16'),(3,'57fd3afca76777.64608971',1,'2016-10-11 19:18:20'),(4,'57fd53bf879e08.59469182',1,'2016-10-11 21:03:59'),(6,'57ffbfea2f5106.78447814',1,'2016-10-13 17:10:02'),(8,'5802752c335ac7.76636044',1,'2016-10-15 18:27:56'),(9,'580784bf812f59.13968024',1,'2016-10-19 14:35:43'),(10,'5807e76478e159.27879382',1,'2016-10-19 21:36:36'),(11,'5811141f2ed2a7.99284473',4,'2016-10-26 20:37:51');
/*!40000 ALTER TABLE `programs_to_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promotions`
--

DROP TABLE IF EXISTS `promotions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promotions` (
  `promotion_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `media_link` varchar(250) NOT NULL,
  `details_link` varchar(150) DEFAULT NULL,
  `media_type` varchar(10) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`promotion_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='promotion part of index page\r\n\r\nmedia types are: video, image';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promotions`
--

LOCK TABLES `promotions` WRITE;
/*!40000 ALTER TABLE `promotions` DISABLE KEYS */;
INSERT INTO `promotions` VALUES (1,'Yoga program','    <h2>Meditation: A complete Guide From A to Z</h2>\r\n                <div class=\"margin-top-25\">  \r\n		Your one-stop meditation reference. A step-by-step guide with all the theory and practice you need to successfully learn and master meditation and harvest it power into your life.\r\n	</div>\r\n\r\n                <h2 class=\"margin-top-40\">Wide range of services</h2>\r\n                <div class=\"margin-top-15\">Interdum et malesuada fames ac ante ipsum primis in faucibus. Nam condimentum laoreet sagittis. Duis quis ullamcorper leo. Suspendisse potenti.</div>','https://player.vimeo.com/video/47000322?title=0&amp;byline=0&amp;portrait=0',NULL,'video',0,'2016-10-09 23:16:27','2016-05-09 07:09:19'),(2,'Yoga program','    <h2>Meditation: A complete Guide From A to Z</h2>\r\n                <div class=\"margin-top-25\">  \r\n		A complete meditation reference and step by step program <strong>created specifically to help people overcome anxiety and panic attacks</strong>. \r\n	</div>\r\n\r\n                <h2 class=\"margin-top-40\">A one-stop for Anxiety and Panic Attacks.</h2>\r\n                <div class=\"margin-top-15\">		\r\n		Now you can self-treat anxiety and panic attacks without expensive therapists and coctail of questionable drugs that alters brain chemistry. Based on 12 years meditation experience and private practice helping people with anxiety and panic attacks.	\r\n	</div>','/assets/images/product_box-with_discs.png','/sp/1','image',1,'2016-10-10 04:29:32','2016-05-09 07:09:19');
/*!40000 ALTER TABLE `promotions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `role_id` char(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='all existing user roles';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES ('571c21d2c153d','admin'),('571c21d2c154e','member');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_details`
--

DROP TABLE IF EXISTS `user_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` char(50) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `avatar_url` varchar(250) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `useer_id` (`user_id`),
  CONSTRAINT `FK_user_details_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COMMENT='contains user details such as first and last names, as well status';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_details`
--

LOCK TABLES `user_details` WRITE;
/*!40000 ALTER TABLE `user_details` DISABLE KEYS */;
INSERT INTO `user_details` VALUES (1,'22923410-00d9-11e6-b4b9-18a905b8e8d0','Dmitri','Saltanovich',NULL,'2016-09-24 22:00:13','2016-05-15 22:01:37'),(3,'575eda2a7bb4f0.03138049','Ilana','Saltanovich',NULL,'2016-06-13 20:07:06','2016-06-13 20:07:06'),(4,'57fd3afca76777.64608971','Shirin','Ahmed',NULL,'2016-10-11 19:18:20','2016-10-11 19:18:20'),(5,'57fd53bf879e08.59469182','Louise Batt','',NULL,'2016-10-11 21:03:59','2016-10-11 21:03:59'),(6,'57fe428ca58314.67407576','Anna','Lopez',NULL,'2016-10-12 14:02:52','2016-10-12 14:02:52'),(7,'57ffbfea2f5106.78447814','Tammy Markus','',NULL,'2016-10-13 17:10:02','2016-10-13 17:10:02'),(9,'5802752c335ac7.76636044','penny brookshire','',NULL,'2016-10-15 18:27:56','2016-10-15 18:27:56'),(10,'580784bf812f59.13968024','Lisa Almaas','',NULL,'2016-10-19 14:35:43','2016-10-19 14:35:43'),(11,'5807e76478e159.27879382','Susan Freeman','',NULL,'2016-10-19 21:36:36','2016-10-19 21:36:36'),(12,'5811141f2ed2a7.99284473','Daniel','Bone',NULL,'2016-10-26 20:37:51','2016-10-26 20:37:51');
/*!40000 ALTER TABLE `user_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_login_history`
--

DROP TABLE IF EXISTS `user_login_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_login_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) CHARACTER SET utf32 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='keeps history on unsuccessfull user logins and used to block people for 30 minutes after 10 unsuccessfull logins';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_login_history`
--

LOCK TABLES `user_login_history` WRITE;
/*!40000 ALTER TABLE `user_login_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_login_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_logins`
--

DROP TABLE IF EXISTS `user_logins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_logins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` char(40) NOT NULL DEFAULT '0',
  `token` varchar(250) NOT NULL DEFAULT '0',
  `user_agent` varchar(250) NOT NULL DEFAULT '0',
  `user_ip` varchar(250) NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_user_logins_users` (`user_id`),
  CONSTRAINT `FK_user_logins_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='a table to track user logins and their details.\r\nContains token which is generated when user logs in, as well user agent (e.g browser) and his IP address';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_logins`
--

LOCK TABLES `user_logins` WRITE;
/*!40000 ALTER TABLE `user_logins` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_logins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` char(50) NOT NULL,
  `email` varchar(50) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL DEFAULT '0',
  `is_active` int(11) NOT NULL DEFAULT '1',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='table of website members';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('22923410-00d9-11e6-b4b9-18a905b8e8d0','dmitri@better-life-tips.com','$2y$10$1wYCjzwwsUmpXuRwFwLNBudzr/oDcVu76NXYipjrhO1SKRAe2VEsq',1,'2016-09-25 16:35:44','2016-04-12 22:05:26'),('575eda2a7bb4f0.03138049','ilana.saltanovich@gmail.com','$2y$10$49L2x9IbFV1CkiOr4vVhJOTPyAME7MPgaVCy9M.OzXh9WV2aJsQXW',1,'2016-06-13 20:07:06','2016-06-13 20:07:06'),('57fd3afca76777.64608971','chini_ahmed@yahoo.com','$2y$10$LKZVePXx37/CwHFu1zf61u.aZMPVSaZuv8lwFJXuE9JxpFohXo8L.',1,'2016-10-11 19:41:35','2016-10-11 19:18:20'),('57fd53bf879e08.59469182','lbrierley07@aol.com','$2y$10$xeef7YaSEjlqPNxrD0uknOiUg7oUxixrsY10nyRnNmlcebjwr3mI2',1,'2016-10-12 05:07:51','2016-10-11 21:03:59'),('57fe428ca58314.67407576','annalopez0989@gmail.com','$2y$10$.hVz77CK9xD5UyO0EkVb/uyZ/182PV6yUD2czKxAD0B4dQT6vY0VG',1,'2016-10-12 15:43:34','2016-10-12 14:02:52'),('57ffbfea2f5106.78447814','tamala171980@yahoo.com','$2y$10$LmJGi90PLv00.dVlA5q.0e5eLSCoXKm.nKKnngQY8jL7zJx8d7RfK',1,'2016-10-13 17:10:02','2016-10-13 17:10:02'),('5802752c335ac7.76636044','pbrooks1960@gmail.com','$2y$10$ef2N/UzeVO/Bq14qUaLpgO4ztlrpsFAN6JUj.pkLnHm/GxX54ZhKO',1,'2016-10-17 18:23:23','2016-10-15 18:27:56'),('580784bf812f59.13968024','lalmaas@shaw.ca','$2y$10$AqrwKx/7A/9DuaA4TM3tn.Ra0FRp5aD8QcddUjtmVJZh6e1gTsJ42',1,'2016-10-19 19:47:15','2016-10-19 14:35:43'),('5807e76478e159.27879382','Susanfreeman1@hotmail.com','$2y$10$KaRYZnnxVQtseImymqPb1uzx/K7edZILal7A7XPeAU4sbiykmxtya',1,'2016-10-19 21:42:46','2016-10-19 21:36:36'),('5811141f2ed2a7.99284473','dbudgetmarketing@gmail.com','$2y$10$03LgeGxF2zR9IL55RSabKOOxiuepX3LfCCCq/MGElw3M21LOudJie',1,'2016-10-26 20:37:51','2016-10-26 20:37:51');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_to_role`
--

DROP TABLE IF EXISTS `users_to_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_to_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` char(50) NOT NULL,
  `role_id` char(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK__users` (`user_id`),
  KEY `FK__roles` (`role_id`),
  CONSTRAINT `FK_users_to_role_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE,
  CONSTRAINT `FK_users_to_role_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_to_role`
--

LOCK TABLES `users_to_role` WRITE;
/*!40000 ALTER TABLE `users_to_role` DISABLE KEYS */;
INSERT INTO `users_to_role` VALUES (6,'22923410-00d9-11e6-b4b9-18a905b8e8d0','571c21d2c153d','2016-05-10 15:55:18'),(8,'575eda2a7bb4f0.03138049','571c21d2c154e','2016-06-13 20:07:06'),(9,'57fd3afca76777.64608971','571c21d2c154e','2016-10-11 19:18:20'),(10,'57fd53bf879e08.59469182','571c21d2c154e','2016-10-11 21:03:59'),(11,'57fe428ca58314.67407576','571c21d2c154e','2016-10-12 14:02:52'),(12,'57ffbfea2f5106.78447814','571c21d2c154e','2016-10-13 17:10:02'),(14,'5802752c335ac7.76636044','571c21d2c154e','2016-10-15 18:27:56'),(15,'580784bf812f59.13968024','571c21d2c154e','2016-10-19 14:35:43'),(16,'5807e76478e159.27879382','571c21d2c154e','2016-10-19 21:36:36'),(17,'5811141f2ed2a7.99284473','571c21d2c154e','2016-10-26 20:37:51');
/*!40000 ALTER TABLE `users_to_role` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-03-10  0:00:02
