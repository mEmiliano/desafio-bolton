setup:
	sudo docker-compose pull
	sudo docker-compose build
	sudo docker-compose up -d
	cp pre-commit-hook .git/hooks/pre-commit
	chmod +x .git/hooks/pre-commit