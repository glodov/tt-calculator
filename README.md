# tt-calculator
Test homework task - create a calculator

### Calc (required) 
In any programming language, implement CLI calculator application that interprets each input line as an expression and prints out expression result, or error message. 
You are not allowed to use frameworks such as symphony, Django etc.
Expression may contain numeric literals, parentheses, mathematical operators and constants E and Pi. Spaces should be ignored. 
In addition, "var = expression" syntax should be supported, in which case variable is created and may be used in following expressions within the same session. 

### Web UI (optional) 
Implement web application that exposes UI mimicking a calculator (similar to calc.exe in Windows), and uses cli calc application at the backend to calculate entered expressions. 

### Extras (optional) 
Include docker file in your solution (for web application). You can help us to better understand how you approach complex tasks by sending us a git repository containing all intermediate commits you made while working on this task. 

## DDD tasks

### Interfaces
Add interfaces into the project.

### Unit tests with PHPUnit
Add unit tests with PHPUnit 9.2+ into the project.

## Solution

### Steps to do tasks:

1. Create a git reposity.
2. Clone it.
3. Create a basic application.
   - test * unit test
4. Create a CLI interface. #1
   - test
5. Create an API.
6. Create a Web interface. #2
   - test
7. Create a Docker config. #3
   - test

### Steps to do (2nd stage) tasks

1. Add `CalculatorInterface`
2. Add new classes impletented the Interface
3. Add PHPUnit tests
   - Run tests with command `php ./vendor/phpunit/phpunit/phpunit`

### Docker config

1. Build docker: `docker build -t calculator .`
2. Run docker: `docker run -p 8080:80 -d calculator`
3. Check container id: `docker ps`
4. Access application from browser: [localhost:8080](http://localhost:8080)

### Requires

Php 7.4+  
Server  
Sass: `npm install -g sass`  
Pug: `npm install -g pug-cli`  
