{
echo ""
echo "status"
sleep 0.5
} | telnet localhost 2>/dev/null | grep "," | grep -v "ERROR" | grep -v "Max" | grep -v "Update" | grep 10.254 | grep $1
