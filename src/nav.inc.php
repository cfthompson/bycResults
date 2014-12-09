<?php
/* 
 * Copyright (C) 2014 rfgunion.
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301  USA
 */
require_once("auth.php");
?>
<div id="nav">
<a href="http://www.berkeleyyc.org">Home</a>
<a href="index.php" class="nav">All Results</a>
<?php $level = getAccessLevel();
if ($level >= User::ADMIN_ACCESS) { ?>
<a href="series.php" class="nav">New Series</a>
<a href="race.php" class="nav">New Race</a>
<a href="logout.php" class="nav">Logout</a>
<?php } else if ($level == User::NO_ACCESS) { ?>
<a href="login.php" class="nav">Login</a>
<?php } ?>
</div>
