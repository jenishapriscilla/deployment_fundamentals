pipeline {
    agent any
    stages  {
        stage('Test') {
            steps {
                sh 'docker-compose up -d'
            }
        }
        stage('Deploy') {
            steps {
                sh 'echo "Deploying application"'
            }
        }
    }
}
