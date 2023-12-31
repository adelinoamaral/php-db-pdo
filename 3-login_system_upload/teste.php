<?php
echo password_hash("rasmuslerdorf", PASSWORD_DEFAULT);
echo "<br>";
echo password_hash("rasmuslerdorf", PASSWORD_BCRYPT);
echo "<br>";
echo password_hash("rasmuslerdorf", PASSWORD_ARGON2I);
echo "<br>";
echo md5("rasmuslerdorf");
echo "<br>";
echo sha1("rasmuslerdorf");
echo "<br>";
echo crypt("rasmuslerdorf");
echo "<br>";
