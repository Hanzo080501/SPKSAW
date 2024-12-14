import { motion } from 'framer-motion';

function Contact() {
  return (
    <div className="pt-16">
      <motion.div
        initial={{ opacity: 0 }}
        animate={{ opacity: 1 }}
        className="max-w-7xl mx-auto px-4 py-16">
        <motion.h1
          initial={{ y: 50, opacity: 0 }}
          animate={{ y: 0, opacity: 1 }}
          className="text-4xl font-bold mb-8">
          Contact Us
        </motion.h1>
        <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
          <motion.form
            initial={{ x: -50, opacity: 0 }}
            animate={{ x: 0, opacity: 1 }}
            className="space-y-6">
            <div>
              <label className="block text-sm font-medium mb-2">Name</label>
              <input
                type="text"
                className="w-full px-4 py-2 rounded-lg bg-dark-secondary border border-gray-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
              />
            </div>
            <div>
              <label className="block text-sm font-medium mb-2">Email</label>
              <input
                type="email"
                className="w-full px-4 py-2 rounded-lg bg-dark-secondary border border-gray-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
              />
            </div>
            <div>
              <label className="block text-sm font-medium mb-2">Message</label>
              <textarea
                rows="4"
                className="w-full px-4 py-2 rounded-lg bg-dark-secondary border border-gray-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"></textarea>
            </div>
            <button
              type="submit"
              className="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
              Send Message
            </button>
          </motion.form>
          <motion.div
            initial={{ x: 50, opacity: 0 }}
            animate={{ x: 0, opacity: 1 }}
            className="bg-dark-secondary p-8 rounded-lg">
            <h2 className="text-2xl font-semibold mb-4">Get in Touch</h2>
            <p className="text-gray-400 mb-6">
              Have questions about electric cars? Were here to help you make the right choice.
            </p>
            <div className="space-y-4">
              <div>
                <h3 className="font-medium">Email</h3>
                <p className="text-gray-400">info@electricauto.com</p>
              </div>
              <div>
                <h3 className="font-medium">Phone</h3>
                <p className="text-gray-400">+1 (555) 123-4567</p>
              </div>
              <div>
                <h3 className="font-medium">Address</h3>
                <p className="text-gray-400">
                  123 Electric Avenue
                  <br />
                  San Francisco, CA 94105
                </p>
              </div>
            </div>
          </motion.div>
        </div>
      </motion.div>
    </div>
  );
}

export default Contact;
