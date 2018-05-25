<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->element('head') ?>
</head>
<body>
    <div class="wrapper">
        <?= $this->element('sidebar') ?>
        <div class="main-panel">
            <?= $this->element('menu') ?>
            <div class="content">
                <div class="message"><?= $this->Flash->render() ?></div>
                <?= $this->fetch('content') ?>
            </div>
        </div>
    </div>
</body>
<?= $this->element('script') ?>
</html>
