pipeline {
    agent any
    stages  {
        stage('checkout') {
            steps {
               git credentialsId: 'gitHub', url: 'https://github.com/jenishapriscilla/DeploymentFundamental'
            }
        }
        stage('Build') {
            steps {
                sh 'docker-compose -f docker-compose.yml up -d'
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
                    sh 'ssh -tt -o StrictHostKeyChecking=no -l ec2-user@172.31.45.119 "docker-compose up --build; bash -l"'
                }
            }
        }
    }
}
