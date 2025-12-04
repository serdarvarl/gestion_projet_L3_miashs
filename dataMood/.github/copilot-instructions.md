# GitHub Copilot Instructions

## About this Project

This project is a data visualization and analysis platform named "dataMood". It has a hybrid architecture combining a PHP web frontend with a Python/Flask backend for data processing and statistical analysis. The database is MySQL.

## Architecture Overview

- **Frontend (PHP)**: Located in `exploitation_data/web/`. These files handle user interface, session management, and direct database interaction for user data. Key files include `index.php`, `login.php`, and `dashboard-free.php`.
- **Backend (Python/Flask API)**: The file `exploitation_data/api_server.py` is a Flask application that provides endpoints for statistical analysis. It uses `pandas` for data manipulation and `matplotlib` to generate and save graphs. It does not connect to the database directly but expects data (likely from CSVs).
- **Database (MySQL)**: The schema and data are defined in `datamoodbd.sql`. The database is named `datamoodbd`. The PHP frontend connects directly to this database.
- **Data**: Raw data is stored in `.csv` files under the `csv/` directory. The `datamoodbd.sql` file also contains the data to be imported.

## Developer Workflow

### Local Setup

1.  **Database Setup**:
    - Make sure you have a MySQL server running (e.g., via MAMP, XAMPP, or Docker).
    - Create a database named `datamoodbd`.
    - Import the schema and data from `datamoodbd.sql`.
    - **Note**: The PHP code has hardcoded database credentials. You may need to update them in files like `exploitation_data/web/index.php` to match your local environment (e.g., `port=3307`, `user=root`, `password=root`).

2.  **Python Backend Setup**:
    - Navigate to the project root.
    - Create and activate a Python virtual environment:
      ```bash
      python -m venv .venv
      source .venv/bin/activate
      ```
    - Install the required dependencies:
      ```bash
      pip install -r requirements.txt
      ```

3.  **Running the Application**:
    - Start the Python API server:
      ```bash
      python exploitation_data/api_server.py
      ```
    - Serve the PHP frontend using a local web server (like Apache or Nginx) with PHP support. The document root should be `exploitation_data/web/`.

### Data Analysis Flow

The core feature is comparing data columns. Here's how it works:

1.  A user selects two data columns to compare in the PHP interface (e.g., `interface_comparasion.php`).
2.  The PHP script sends a request to the Python Flask API (`api_server.py`).
3.  The Flask API receives the column names, performs statistical analysis (like Chi-Squared or ANOVA), and generates a plot using `matplotlib`.
4.  The plot is saved as an image file in `exploitation_data/web/graphs/`.
5.  The API returns a JSON response to the PHP script containing the statistical results and the path to the generated graph.
6.  The PHP script displays the results and the graph image to the user.

## Project Conventions

- The project uses a mix of PHP for the web frontend and Python for data-intensive tasks. This separation of concerns is a key architectural pattern.
- The Python API is stateless and operates on data passed to it, making it decoupled from the database.
- Database credentials in PHP files are hardcoded. Be careful not to commit real credentials.
- The `analysis_view` in the database is a pre-joined view for simplifying queries for analysis.
