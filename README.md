# Code Challenge Sep 18, 2021

Challenge time : 2 hours

### notes

- spa (web and desktop)
- records text audio
- rest api backend

### Tech stack

- frontend
  - vuejs
    - VueJS - faster UI/UX development, easier to make change in the UI for simultaneous events
    - socket.io - even though that there are other socket servers, such as mqtt and others, socket.io is the one i feel most confortable and as a simple implementation
    - for the desktop app I mainly would build it with an electron wrapper considering I have prior experience with it so I am confortable with it
- backend
  - rest api
    - php/laravel - easy to use file storing system, simpler scalability (in case of demand we could implement AWS S3 storage system to store the audio files), easy rest api development and to implement auth validations such as jwt auth and oauth2.0, migrations makes it simpler in case we need to change database types
  - audio processing
    - speech to text - python algorithm
    - text to speech - python algorithm
  - text processing
    - rest api service

### other notes

Due to lack of time and for the sake of showing code quality I used a prebuilt setup for the docker containers. With more time my intentions would be having a seperate container, for php, nginx, mysql and not all together. because when we can have nginx and php seperated the scalability for the webserver load balancing gets easier to implement and maintain.

### other code notes

I use a repository pattern mainly because it is easier to maintain functions when they are large scale and are used across the app frequently.

### instalation notes

1. `cd api && cp .example.env .env`
2. `docker-compose up -d --build`
3. `chmod +x .perms.sh`
4. `sh .perms.sh`
5. access localhost:8080
6. to test api make a post request to /api/audio with the email and audio file
