pipeline {
    agent any
    stages  {
        stage('Test') {
            steps {
               git credentialsId: 'gitHub', url: 'https://github.com/jenishapriscilla/DeploymentFundamental'
            }
        }
        stage(‘Build’) {
            steps {
            sh '/usr/local/bin/docker-compose up --build'
            }
        }
        stage('Deploy') {
            steps {
                withCredentials([usernamePassword(credentialsId: 'dockerHub', passwordVariable: 'dockerPassword', usernameVariable: 'dockerUsername')]) {
                    sh "docker login -u ${dockerUsername} -p ${dockerPassword}"
                }
                sh 'docker push dackerkosaksi/nginx'
            }
        }
    }
}
