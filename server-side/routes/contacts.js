const express = require("express");
const { v4: uuidv4 } = require("uuid");
const router = express.Router();
const Contact = require("../models/contact");

// Create a new contact
router.post("/", async (req, res) => {
  const {
    username,
    email,
    nama_lengkap,
    no_ktp,
    no_hp,
    jenis_kelamin,
    alamat_lengkap,
    kecamatan,
    kabupaten_kota,
    provinsi,
    kode_pos,
    status_akun,
  } = req.body;
  try {
    const contact = await Contact.create({
      user_id: uuidv4(),
      username,
      email,
      nama_lengkap,
      no_ktp,
      no_hp,
      jenis_kelamin,
      alamat_lengkap,
      kecamatan,
      kabupaten_kota,
      provinsi,
      kode_pos,
      status_akun,
    });
    res.status(201).json(contact);
  } catch (error) {
    res.status(400).json({ error: error.message });
  }
});

// Get all contacts
router.get("/", async (req, res) => {
  try {
    const contacts = await Contact.findAll();
    res.json(contacts);
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

// Get a contact by ID
router.get("/:id", async (req, res) => {
  try {
    const contact = await Contact.findByPk(req.params.id);
    if (contact) {
      res.json(contact);
    } else {
      res.status(404).json({ error: "Contact not found" });
    }
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

// Update a contact
router.put("/:id", async (req, res) => {
  try {
    const contact = await Contact.findByPk(req.params.id);
    if (contact) {
      await contact.update(req.body);
      res.json(contact);
    } else {
      res.status(404).json({ error: "Contact not found" });
    }
  } catch (error) {
    res.status(400).json({ error: error.message });
  }
});

// Delete a contact
router.delete("/:id", async (req, res) => {
  try {
    const contact = await Contact.findByPk(req.params.id);
    if (contact) {
      await contact.destroy();
      res.json({ message: "Contact deleted" });
    } else {
      res.status(404).json({ error: "Contact not found" });
    }
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

module.exports = router;
