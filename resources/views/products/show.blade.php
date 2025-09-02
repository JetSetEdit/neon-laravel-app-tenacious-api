<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - Tape Products</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
        }
        
        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 40px;
            padding: 40px 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 12px;
        }
        
        .header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        
        .header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        
        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: background 0.3s;
        }
        
        .back-link:hover {
            background: #5a6fd8;
        }
        
        .product-detail-table {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-bottom: 30px;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .table th {
            background: #667eea;
            color: white;
            padding: 15px 20px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
            width: 200px;
        }
        
        .table td {
            padding: 15px 20px;
            border-bottom: 1px solid #e1e5e9;
            vertical-align: top;
        }
        
        .table tr:last-child td {
            border-bottom: none;
        }
        
        .product-code {
            background: #667eea;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
            display: inline-block;
        }
        
        .product-name {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2d3748;
        }
        
        .product-description {
            color: #666;
            font-size: 16px;
            line-height: 1.5;
        }
        
        .product-application {
            color: #666;
            font-size: 16px;
            line-height: 1.5;
        }
        
        .category-name {
            color: #667eea;
            font-weight: 600;
            font-size: 16px;
        }
        
        .created-date {
            color: #666;
            font-size: 14px;
        }
        
        .view-toggle {
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
            justify-content: center;
        }
        
        .view-btn {
            padding: 10px 20px;
            border: 2px solid #e1e5e9;
            border-radius: 8px;
            background: white;
            color: #667eea;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 14px;
            font-weight: 500;
        }
        
        .view-btn:hover {
            border-color: #667eea;
        }
        
        .view-btn.active {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }
        
        .json-view {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-bottom: 30px;
        }
        
        .json-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background: #f8f9fa;
            border-bottom: 1px solid #e1e5e9;
        }
        
        .json-header h3 {
            margin: 0;
            color: #2d3748;
        }
        
        .copy-btn {
            padding: 10px 20px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s;
        }
        
        .copy-btn:hover {
            background: #218838;
        }
        
        .json-content {
            padding: 20px;
            background: #2d3748;
            color: #e2e8f0;
            font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
            font-size: 13px;
            line-height: 1.5;
            overflow-x: auto;
            margin: 0;
            white-space: pre-wrap;
        }
        
        @media (max-width: 768px) {
            .table th {
                width: 150px;
            }
            
            .header h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('products.index') }}" class="back-link">← Back to Products</a>
        
        <div class="header">
            <h1>🎯 {{ $product->name }}</h1>
            <p>Product Details</p>
        </div>
        
        <div class="view-toggle">
            <button id="tableViewBtn" class="view-btn active" onclick="switchView('table')">Table View</button>
            <button id="jsonViewBtn" class="view-btn" onclick="switchView('json')">JSON View</button>
        </div>
        
        <div id="product-detail-table" class="product-detail-table">
            <table class="table">
                <tbody>
                    <tr>
                        <th>Product Code</th>
                        <td>
                            <div class="product-code">{{ $product->product_code }}</div>
                        </td>
                    </tr>
                    <tr>
                        <th>Product Name</th>
                        <td>
                            <div class="product-name">{{ $product->name }}</div>
                        </td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>
                            <div class="product-description">{{ $product->description }}</div>
                        </td>
                    </tr>
                    <tr>
                        <th>Application</th>
                        <td>
                            <div class="product-application">{{ $product->application }}</div>
                        </td>
                    </tr>
                    <tr>
                        <th>Category</th>
                        <td>
                            <div class="category-name">{{ $product->category->name }}</div>
                        </td>
                    </tr>
                    <tr>
                        <th>Created</th>
                        <td>
                            <div class="created-date">{{ $product->created_at->format('F j, Y') }}</div>
                        </td>
                    </tr>
                    <tr>
                        <th>Last Updated</th>
                        <td>
                            <div class="created-date">{{ $product->updated_at->format('F j, Y') }}</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- JSON View (Hidden by default) -->
        <div id="jsonView" class="json-view" style="display: none;">
            <div class="json-header">
                <h3>JSON Data</h3>
                <button id="copyJsonBtn" class="copy-btn" onclick="copyToClipboard()">
                    📋 Copy to Clipboard
                </button>
            </div>
            <pre id="jsonContent" class="json-content"></pre>
        </div>
            </div>
        
        <script>
            // Prepare JSON data for single product
            const productData = @json($product);
            const categoryData = @json($product->category);
            
            // Create the full API response structure
            const apiResponse = {
                status: "success",
                message: "Product retrieved successfully",
                data: {
                    ...productData,
                    category: categoryData
                }
            };
            
            // Switch between table and JSON views
            function switchView(view) {
                const tableView = document.getElementById('product-detail-table');
                const jsonView = document.getElementById('jsonView');
                const tableBtn = document.getElementById('tableViewBtn');
                const jsonBtn = document.getElementById('jsonViewBtn');
                
                if (view === 'table') {
                    tableView.style.display = 'block';
                    jsonView.style.display = 'none';
                    tableBtn.classList.add('active');
                    jsonBtn.classList.remove('active');
                } else {
                    tableView.style.display = 'none';
                    jsonView.style.display = 'block';
                    jsonBtn.classList.add('active');
                    tableBtn.classList.remove('active');
                    
                    // Display formatted JSON
                    document.getElementById('jsonContent').textContent = JSON.stringify(apiResponse, null, 2);
                }
            }
            
            // Copy JSON to clipboard
            function copyToClipboard() {
                const jsonContent = document.getElementById('jsonContent').textContent;
                
                navigator.clipboard.writeText(jsonContent).then(function() {
                    const copyBtn = document.getElementById('copyJsonBtn');
                    const originalText = copyBtn.innerHTML;
                    copyBtn.innerHTML = '✅ Copied!';
                    copyBtn.style.background = '#28a745';
                    
                    setTimeout(function() {
                        copyBtn.innerHTML = originalText;
                        copyBtn.style.background = '#28a745';
                    }, 2000);
                }).catch(function(err) {
                    console.error('Could not copy text: ', err);
                    alert('Copy failed. Please select and copy manually.');
                });
            }
        </script>
    </body>
</html>
