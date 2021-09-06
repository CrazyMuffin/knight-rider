# Knight Rider

A simple app that provides the shortest path a knight figure can move on user-defined-sized chessboard between two points, by standard chess rules.

## Get started
 1. Checkout this repository
 2. Install composer packages
```
composer install
```
 3. Run php server
```
 php -S localhost:8888 -t public
```
 4. Visit the URL or call via Postman
```
localhost:8888/knight/{chessboardSize}/{startPositionX},{startPositionY}/{endPositionX},{endPositionY}
```

Example:
To find the path between fields A1 and B2 on standard 8x8 chessboard:
```
localhost:8888/knight/8/0,0/1,1
```