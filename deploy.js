const FtpDeploy = require("ftp-deploy");
const path = require("path");

const ftpDeploy = new FtpDeploy();

const config = {
  user: process.env.FTP_USER,       // Usuário FTP
  password: process.env.FTP_PASSWORD, // Senha FTP
  host: process.env.FTP_HOST,       // Host FTP
  port: process.env.FTP_PORT || 21, // Porta FTP
  localRoot: path.join(__dirname, "dist"),
  remoteRoot: "/",
  include: ["*", "**/*"],
  deleteRemote: true,
  forcePasv: true
};

// Evento de progresso (mostra cada arquivo enviado)
ftpDeploy.on("uploaded", (data) => {
  console.log(`✅ Arquivo enviado: ${data.transferredFileCount}/${data.totalFilesCount} - ${data.filename}`);
});

ftpDeploy.on("deleted", (data) => {
  console.log(`🗑 Arquivo deletado no servidor: ${data.filename}`);
});

// Evento quando o deploy começar
ftpDeploy.on("uploading", (data) => {
  console.log(`📤 Enviando: ${data.filename}...`);
});

// Evento quando o deploy terminar
ftpDeploy.on("log", (message) => {
  console.log(`ℹ️ ${message}`);
});

// Evento quando o deploy for concluído
ftpDeploy.deploy(config)
  .then(() => console.log("🚀 Deploy para o FTP concluído com sucesso!"))
  .catch((err) => console.error("❌ Erro no deploy:", err));
