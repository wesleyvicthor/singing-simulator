Singing Simulator
==============

This project provides a simulator of a singing contest applying rules for scoring based
on each Judge Type.  

It uses pure PHP with Symfony Console Component to provide an interactive CLI interface

Installing  
```bash
~$ docker-compose build
```

```bash
~$ docker-compose up
```

In another terminal session run  
```bash
~$ docker exec -it singing-simulator_app_1 bin/play
```

View histories with  
```bash
~$ docker exec -it singing-simulator_app_1 bin/play --history=true
```
