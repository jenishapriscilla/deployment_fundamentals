pipeline {
    agent any
    stages  {
        stage('Test') {
            steps {
               git credentialsId: 'gitHub', url: 'https://github.com/jenishapriscilla/DeploymentFundamental'
            }
        }
        stage('Deploy') {
            steps {
                sh 'echo "Deploying application"'
            }
        }
    }
}
