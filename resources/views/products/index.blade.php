<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tape Products - Tenacious API</title>
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
            max-width: 1200px;
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
        
        .search-section {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .search-form {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }
        
        .search-input {
            flex: 1;
            min-width: 200px;
            padding: 12px 16px;
            border: 2px solid #e1e5e9;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        
        .search-input:focus {
            outline: none;
            border-color: #667eea;
        }
        
        .search-button {
            padding: 12px 24px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }
        
        .search-button:hover {
            background: #5a6fd8;
        }
        
        .category-filter {
            padding: 12px 16px;
            border: 2px solid #e1e5e9;
            border-radius: 8px;
            font-size: 16px;
            background: white;
        }
        
        .view-toggle {
            margin-top: 20px;
            display: flex;
            gap: 10px;
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
        
        .products-table {
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
        }
        
        .table td {
            padding: 15px 20px;
            border-bottom: 1px solid #e1e5e9;
            vertical-align: top;
        }
        
        .table tr:hover {
            background-color: #f8f9fa;
        }
        
        .table tr:last-child td {
            border-bottom: none;
        }
        
        .product-code {
            background: #667eea;
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            display: inline-block;
        }
        
        .product-name {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 5px;
        }
        
        .product-name-link {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }
        
        .product-name-link:hover {
            color: #5a6fd8;
            text-decoration: underline;
        }
        
        .product-description {
            color: #666;
            font-size: 14px;
            line-height: 1.4;
        }
        
        .product-application {
            color: #666;
            font-size: 14px;
            line-height: 1.4;
        }
        
        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 30px;
        }
        
        .pagination a {
            padding: 10px 15px;
            background: white;
            border: 1px solid #e1e5e9;
            border-radius: 6px;
            text-decoration: none;
            color: #667eea;
            transition: all 0.3s;
        }
        
        .pagination a:hover {
            background: #667eea;
            color: white;
        }
        
        .pagination .active {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }
        
        .no-products {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }
        
        @media (max-width: 768px) {
            .products-grid {
                grid-template-columns: 1fr;
            }
            
            .search-form {
                flex-direction: column;
            }
            
            .header h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎯 Tape Products</h1>
            <p>Professional adhesive solutions for every application</p>
        </div>
        
        <div class="search-section">
            <form method="GET" action="{{ route('products.index') }}" class="search-form">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Search products, codes, or descriptions..." 
                    value="{{ $search }}"
                    class="search-input"
                >
                
                <select name="category" class="category-filter">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $category == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                
                <button type="submit" class="search-button">Search</button>
            </form>
            
            <div class="view-toggle">
                <button id="tableViewBtn" class="view-btn active" onclick="switchView('table')">Table View</button>
                <button id="jsonViewBtn" class="view-btn" onclick="switchView('json')">JSON View</button>
            </div>
        </div>
        
        @if($products->count() > 0)
            <div id="products-table" class="products-table">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Description</th>
                            <th>Application</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>
                                    <div class="product-code">{{ $product->product_code }}</div>
                                </td>
                                <td>
                                    <a href="{{ route('products.show', $product->id) }}" class="product-name-link">
                                        {{ $product->name }}
                                    </a>
                                </td>
                                <td>
                                    <div class="product-description">{{ $product->description }}</div>
                                </td>
                                <td>
                                    <div class="product-application">{{ $product->application }}</div>
                                </td>
                            </tr>
                        @endforeach
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
            
            @if($products->hasPages())
                <div class="pagination">
                    @if($products->onFirstPage())
                        <span class="active">1</span>
                    @else
                        <a href="{{ $products->previousPageUrl() }}">Previous</a>
                        <a href="{{ $products->url(1) }}">1</a>
                    @endif
                    
                    @if($products->currentPage() > 2)
                        <span>...</span>
                    @endif
                    
                    @if($products->currentPage() > 1 && $products->currentPage() < $products->lastPage())
                        <span class="active">{{ $products->currentPage() }}</span>
                    @endif
                    
                    @if($products->currentPage() < $products->lastPage() - 1)
                        <span>...</span>
                    @endif
                    
                    @if($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}">Next</a>
                    @endif
                </div>
            @endif
        @else
            <div class="no-products">
                <h3>No products found</h3>
                <p>Try adjusting your search criteria or browse all categories.</p>
            </div>
        @endif
            </div>
        
        <script>
            // Prepare JSON data
            const productsData = @json($products);
            const categoriesData = @json($categories);
            
            // Create the full API response structure
            const apiResponse = {
                status: "success",
                message: "Products retrieved successfully",
                data: productsData.data,
                pagination: productsData.pagination,
                categories: categoriesData
            };
            
            // Switch between table and JSON views
            function switchView(view) {
                const tableView = document.getElementById('products-table');
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
