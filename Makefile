SRC = ./docker-compose.yml
NAME = Akaunting 

all : ${NAME}

${NAME}:
	docker-compose up

ENV: .env.example
	cp .env.example .env

re : fclean all

clean :
	docker-compose -f ${SRC} down

fclean :
	docker-compose -f ${SRC} down --rmi all