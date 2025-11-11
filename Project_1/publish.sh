#!/usr/bin/env bash


REPO=${DOCKERHUB_REPO:-}
TAG=${IMAGE_TAG:-latest}

if [ -z "$REPO" ]; then
	echo "Error: DOCKERHUB_REPO is not set"
	exit 1
fi

IMAGE="$REPO:$TAG"

echo "Building image $IMAGE..."
docker build -t "$IMAGE" .

echo "Pushing $IMAGE to Docker Hub..."
docker push "$IMAGE"

if [ $? -eq 0 ]; then
	echo "Successfully pushed $IMAGE"
else
	echo "Push failed"
	exit 1
fi