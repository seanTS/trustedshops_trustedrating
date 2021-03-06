<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * Get email templates and put them into the database
 *
 * SUPTRUSTEDSHOPS-129: Submission of reminder emails from the Magento host is replaced by
 * Trusted Shops' 'Rate later' service thus email and additional table are not necessary anymore.
 *
 * @category   Symmetrics
 * @package    Symmetrics_TrustedRating
 * @author     symmetrics - a CGI Group brand <info@symmetrics.de>
 * @author     Siegfried Schmitz <ss@symmetrics.de>
 * @author     Ngoc Anh Doan <ngoc-anh.doan@cgi.com>
 * @copyright  2009-2014 symmetrics - a CGI Group brand
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link       https://github.com/symmetrics/trustedshops_trustedrating/
 * @link       http://www.symmetrics.de/
 * @link       http://www.de.cgi.com/
 * @deprecated since v0.2.4
 * @todo       Delete table via upgrade script for existing table/installations.
 */

$installer = $this;
$installer->startSetup();

foreach ($this->getConfigEmails() as $name => $data) {
    if ($data['execute'] == 1) {
        $this->createEmail($data);
    }
}

$query = <<< EOF
    CREATE TABLE IF NOT EXISTS {$this->getTable('symmetrics_trustedrating_emails')} (
      `entity_id` int(11) NOT NULL AUTO_INCREMENT,
      `shippment_id` int(11) NOT NULL,
      PRIMARY KEY (`entity_id`)
    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
EOF;

$installer->run($query);

$installer->endSetup();
