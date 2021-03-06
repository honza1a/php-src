--TEST--
Test dechex() function : usage variations - different data types as $num arg
--INI--
precision=14
--SKIPIF--
<?php
if (PHP_INT_SIZE != 4) die("skip this test is for 32bit platform only");
?>
--FILE--
<?php
echo "*** Testing dechex() : usage variations ***\n";

// heredoc string
$heredoc = <<<EOT
abc
xyz
EOT;

// get a class
class classA
{
}

// get a resource variable
$fp = fopen(__FILE__, "r");

$inputs = array(
       // int data
/*1*/  0,
       1,
       12345,
       -2345,
       4294967295,  // largest decimal
       4294967296,

       // float data
/*7*/  10.5,
       -10.5,
       12.3456789000e10,
       12.3456789000E-10,
       .5,

       // boolean data
/*14*/ true,
       false,
       TRUE,
       FALSE,

       // empty data
/*18*/ "",
       '',
       array(),

       // string data
/*21*/ "abcxyz",
       'abcxyz',
       $heredoc,

       // object data
/*24*/ new classA(),

       // resource variable
/*27*/ $fp
);

// loop through each element of $inputs to check the behaviour of dechex()
foreach($inputs as $i => $input) {
    $iterator = $i + 1;
    echo "\n-- Iteration $iterator --\n";
    try {
        var_dump(dechex($input));
    } catch (TypeError $exception) {
        echo $exception->getMessage() . "\n";
    }
    $iterator++;
}
fclose($fp);

?>
--EXPECT--
*** Testing dechex() : usage variations ***

-- Iteration 1 --
string(1) "0"

-- Iteration 2 --
string(1) "1"

-- Iteration 3 --
string(4) "3039"

-- Iteration 4 --
string(8) "fffff6d7"

-- Iteration 5 --
dechex(): Argument #1 ($num) must be of type int, float given

-- Iteration 6 --
dechex(): Argument #1 ($num) must be of type int, float given

-- Iteration 7 --
string(1) "a"

-- Iteration 8 --
string(8) "fffffff6"

-- Iteration 9 --
dechex(): Argument #1 ($num) must be of type int, float given

-- Iteration 10 --
string(1) "0"

-- Iteration 11 --
string(1) "0"

-- Iteration 12 --
string(1) "1"

-- Iteration 13 --
string(1) "0"

-- Iteration 14 --
string(1) "1"

-- Iteration 15 --
string(1) "0"

-- Iteration 16 --
dechex(): Argument #1 ($num) must be of type int, string given

-- Iteration 17 --
dechex(): Argument #1 ($num) must be of type int, string given

-- Iteration 18 --
dechex(): Argument #1 ($num) must be of type int, array given

-- Iteration 19 --
dechex(): Argument #1 ($num) must be of type int, string given

-- Iteration 20 --
dechex(): Argument #1 ($num) must be of type int, string given

-- Iteration 21 --
dechex(): Argument #1 ($num) must be of type int, string given

-- Iteration 22 --
dechex(): Argument #1 ($num) must be of type int, classA given

-- Iteration 23 --
dechex(): Argument #1 ($num) must be of type int, resource given
