<?php

/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace EasyWPSMTP\Vendor\Monolog\Handler;

use EasyWPSMTP\Vendor\Monolog\Formatter\JsonFormatter;
use EasyWPSMTP\Vendor\Monolog\Logger;
/**
 * CouchDB handler
 *
 * @author Markus Bachmann <markus.bachmann@bachi.biz>
 */
class CouchDBHandler extends \EasyWPSMTP\Vendor\Monolog\Handler\AbstractProcessingHandler
{
    private $options;
    public function __construct(array $options = array(), $level = \EasyWPSMTP\Vendor\Monolog\Logger::DEBUG, $bubble = \true)
    {
        $this->options = \array_merge(array('host' => 'localhost', 'port' => 5984, 'dbname' => 'logger', 'username' => null, 'password' => null), $options);
        parent::__construct($level, $bubble);
    }
    /**
     * {@inheritDoc}
     */
    protected function write(array $record)
    {
        $basicAuth = null;
        if ($this->options['username']) {
            $basicAuth = \sprintf('%s:%s@', $this->options['username'], $this->options['password']);
        }
        $url = 'http://' . $basicAuth . $this->options['host'] . ':' . $this->options['port'] . '/' . $this->options['dbname'];
        $context = \stream_context_create(array('http' => array('method' => 'POST', 'content' => $record['formatted'], 'ignore_errors' => \true, 'max_redirects' => 0, 'header' => 'Content-type: application/json')));
        if (\false === @\file_get_contents($url, null, $context)) {
            throw new \RuntimeException(\sprintf('Could not connect to %s', $url));
        }
    }
    /**
     * {@inheritDoc}
     */
    protected function getDefaultFormatter()
    {
        return new \EasyWPSMTP\Vendor\Monolog\Formatter\JsonFormatter(\EasyWPSMTP\Vendor\Monolog\Formatter\JsonFormatter::BATCH_MODE_JSON, \false);
    }
}
