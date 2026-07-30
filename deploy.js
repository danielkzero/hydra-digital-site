const FtpDeploy = require("ftp-deploy");
const path = require("path");
const fs = require("fs");
require("dotenv").config(); // Carrega variáveis do .env

const ftpDeploy = new FtpDeploy();

// Verifica se as variáveis essenciais estão definidas
const requiredEnv = ["FTP_USER", "FTP_PASSWORD", "FTP_HOST"];
const missingEnv = requiredEnv.filter(key => !process.env[key]);

if (missingEnv.length > 0) {
  console.error(`❌ Variáveis de ambiente ausentes: ${missingEnv.join(", ")}`);
  process.exit(1);
}

// Verifica se a pasta dist existe
const localRoot = path.join(__dirname, "dist");
if (!fs.existsSync(localRoot)) {
  console.error(`❌ A pasta de build não foi encontrada: ${localRoot}`);
  console.error("Execute o build do projeto antes de fazer o deploy: npm run build");
  process.exit(1);
}

const config = {
  user: process.env.FTP_USER,
  password: process.env.FTP_PASSWORD,
  host: process.env.FTP_HOST,
  port: process.env.FTP_PORT || 21,
  localRoot: localRoot,
  remoteRoot: "/",
  include: ["*", "**/*"],
  deleteRemote: true,
  forcePasv: true
};

// Eventos de progresso
ftpDeploy.on("uploaded", (data) => {
  console.log(`✅ Arquivo enviado: ${data.transferredFileCount}/${data.totalFilesCount} - ${data.filename}`);
});

ftpDeploy.on("deleted", (data) => {
  console.log(`🗑 Arquivo deletado no servidor: ${data.filename}`);
});

ftpDeploy.on("uploading", (data) => {
  console.log(`📤 Enviando: ${data.filename}...`);
});

ftpDeploy.on("log", (message) => {
  console.log(`ℹ️ ${message}`);
});

// Executa o deploy
ftpDeploy.deploy(config)
  .then(() => console.log("🚀 Deploy para o FTP concluído com sucesso!"))
  .catch((err) => console.error("❌ Erro no deploy:", err));
