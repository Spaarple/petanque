# Remove all Docker containers
docker container rm -f $(docker container ls -aq)

# Remove all Docker images
docker image rm -f $(docker image ls -aq)

# Start Docker Compose
docker-compose up