def dockerRun = 'docker-compose up --build; bash -l'
pipeline {
    agent any
    stages  {
        stage('checkout') {
            steps {
               git credentialsId: 'gitHub', url: 'https://github.com/jenishapriscilla/DeploymentFundamental'
            }
        }
        stage('Deploy') {
            steps {
                withCredentials([usernamePassword(credentialsId: 'dockerHub', passwordVariable: 'dockerPassword', usernameVariable: 'dockerUsername')]) {
                    sh "docker login -u ${dockerUsername} -p ${dockerPassword}"
                }
                sh 'docker tag nginx:latest dackerkosaksi/nginx'
                sh 'docker push dackerkosaksi/nginx'
            }
        }
        stage('Run Container on Dev Server') {
            steps {
                sshagent(['aws-host']) {
                    sh "ssh -tt -o StrictHostKeyChecking=no ec2-user@ec2-18-225-11-116.us-east-2.compute.amazonaws.com 'docker run -p 80:80 dackerkosaksi/nginx'"
                }
            }
        }
    }
}
