<?php

namespace Social\ManagerBundle\Console\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Facebook\Facebook;
use Social\ManagerBundle\SocialManagerBundle as MiniLib;

class FeedFacebookCommand extends ContainerAwareCommand {

    protected function configure() {
        $this
                ->setName('FeedFacebook')
                ->addArgument(
                        'id', InputArgument::OPTIONAL, 'Who do you want to send mail?'
                )
                ->setDescription('Runs Cron Tasks if needed')
                ->addOption(
                        'yell', null, InputOption::VALUE_NONE, 'If set, the task will yell in uppercase letters'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $container = $this->getContainer();
        $em = $container->get('doctrine.orm.entity_manager');

        $output->writeln('<comment>Start</comment>');

        $check = $em->getRepository('SocialManagerBundle:Feeds')->getTop();

        if ($check) {

            $fbApp = new Facebook(array('app_id' => MiniLib::$fb_app, 'app_secret' => MiniLib::$fb_key));

//            $em->getConnection()->beginTransaction();
            try {
                $arrId = array();
                foreach ($check as $value) {

                    $arrId[] = $value->getId();

                    $token = $em->getRepository('SocialManagerBundle:Tokens')->findOneBy(
                            array(
                                "p_id" => $value->getPId(),
                                "u_id" => $value->getUId()
                            )
                    );
                    if ($token) {
                        if ($token->getTokenFacebook()) {
                            $fbApp->setDefaultAccessToken($token->getTokenFacebook());
                        } else {
                            $check = $em->getRepository('SocialManagerBundle:Users')->findOneBy(
                                    array(
                                        "id" => $value->getUId()
                                    )
                            );
                            $fbApp->setDefaultAccessToken($check->getTokenFacebook());
                        }

                        if ($value->getTypeFeed() == "text") {
                            $data = ['message' => $value->getMessage()];
                        } else if ($value->getTypeFeed() == "video") {
                            $data = [
                                'caption' => $value->getLinkTitle(),
                                'description' => $value->getDescription(),
                                'link' => $value->getImageUrl()
                            ];
                        } else if ($value->getTypeFeed() == "image") {
                            $data = [
                                'message' => $value->getDescription(),
                                'picture' => $value->getImageUrl()
                            ];
                        } else if ($value->getTypeFeed() == "link") {
                            $data = [
                                'message' => $value->getMessage(),
                                'name' => $value->getLinkTitle(),
                                'description' => $value->getDescription(),
                                'caption' => $value->getCaption(),
                                'picture' => $value->getImageUrl(),
                                'link' => $value->getLinkUrl()
                            ];
                        }

                        $response = $fbApp->post('/' . $value->getPId() . '/feed', $data);

                        $id = $response->getDecodedBody();
                        $id = $id["id"];
                        $value->setFeedId($id);
                        $value->setStatus(1);
                        $em->persist($value);
                        $em->flush();
                    }
                }

                $output->writeln('<comment>feeded</comment>');
            } catch (\Exception $e) {
                $output->writeln('<comment>error</comment>');
//                $em->getConnection()->rollback();
            }
        }
        $output->writeln('<comment>Done</comment>');
    }

}
