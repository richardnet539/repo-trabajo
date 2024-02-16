#!/bin/bash

INSTANCE_NAME=$1
IMAGE_URI=$2
ZONE=$3
PROJECT_ID=$4
MACHINE_TYPE=${5:-"e2-small"}

# Check if the instance already exists
if gcloud compute instances describe $INSTANCE_NAME --zone $ZONE --project $PROJECT_ID 2>/dev/null; then
    echo "Instance exists, updating container..."
    gcloud compute instances update-container $INSTANCE_NAME \
        --zone $ZONE \
        --container-image $IMAGE_URI \
        --project $PROJECT_ID
else
    echo "Instance does not exist, creating..."
    gcloud compute instances create-with-container $INSTANCE_NAME \
        --zone $ZONE \
        --machine-type $MACHINE_TYPE \
        --container-image $IMAGE_URI \
        --project $PROJECT_ID
fi
