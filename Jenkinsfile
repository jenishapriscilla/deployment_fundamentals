pipeline {
    agent any
    stages  {
        stage('Test') {
            steps {
                sh '''
                    docker --version
                    docker compose version
                '''
            }
        }
        stage('Deploy') {
            steps {
                sh 'echo "Deploying application"'
            }
        }
    }
}
