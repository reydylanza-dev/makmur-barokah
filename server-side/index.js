const express = require("express");
const bodyParser = require("body-parser");
const contactRoutes = require("./routes/contacts");
const sequelize = require("./config/db");

const app = express();
const PORT = 5000;

app.use(bodyParser.json());

app.use("/api/contacts", contactRoutes);

// Sinkronisasi model dengan database
sequelize
  .sync({ alter: true }) // alter: true will update the table if necessary without dropping it
  .then(() => {
    app.listen(PORT, () => {
      console.log(`Server is running on http://localhost:${PORT}`);
    });
  })
  .catch((err) => {
    console.error("Unable to synchronize the database:", err);
  });
