#!/bin/sh

curl -s https://api.github.com/users/$1 | \
     awk -F '"' '
         /\"name\":/{print $4}
         /\"bio\":/{print $4}
         /\"location\":/{print $4}
         /\"blog\":/{print $4}
         '