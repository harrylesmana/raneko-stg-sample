<?php

/**
 * Raw testing template.
 * @author Harry Lesmana <harry.lesmana@msn.com>
 * @since 2021-04-04
 */
require_once "vendor/autoload.php";

/* Set environment path */
\Stg\Raneko\App::setEnvPath("C:/VHOST/source-php/raneko-stg-sample/app");

/* Put your testing code below this line */
print_r(\Stg\Raneko\App::getEnvPath());

/**
 * Preparing entity.
 */
$entity = new \Stg\Raneko\Model\Entity\TemplateComm();
$entity->setCode("test");
$entity->setBody("body");
$entity->setSubject("subject");
$entity->setSender("sender");
$entity->setSenderAddress("no-reply@example.com");
$entity->setDescription(\Stg\Raneko\App::uuid4());
$entity->setOwnerType("platform");
$entity->setLabel("label");
$entity->setCreatedBy("1");

/**
 * Preparing Request #1 (create).
 */
$request1 = new \Stg\Raneko\API\Model\Request();
$request1->setEntity("template_comm")->setAction("create");
$request1->addEntityObject($entity);
$request1->addEntityObject($entity);

/**
 * Consolidate all Request into Envelope.
 */
$requestEnvelope = \Stg\Raneko\API\Model\Envelope::factory();
$requestEnvelope->setToken(\Stg\Raneko\App::uuid4());
$requestEnvelope->addRequest($request1);

$gateway = \Stg\Raneko\App::getApiGateway();
$gateway->setRequestEnvelope($requestEnvelope);
$gateway->execute();

print_r($requestEnvelope->getRequest());
print_r($gateway->getResponseEnvelope()->getResponse());